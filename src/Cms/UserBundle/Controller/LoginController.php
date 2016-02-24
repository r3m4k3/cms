<?php

namespace Cms\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\SecurityContext;

use Cms\UserBundle\Form\LoginForm;
use Cms\UserBundle\Form\ResetPasswordForm;
use Cms\UserBundle\Entity\Token;
use Cms\UtilBundle\Entity\Mail;
use Cms\UtilBundle\Constant\MailTypesConstants;

class LoginController extends Controller
{

    public function indexAction()
    {

         = $this->container->getParameter('accounts');
        var_dump($t); exit;

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER') === true) {
            $redirectURL = $this->generateUrl('my_account');
            return $this->redirect($redirectURL);
        }

        $form = $this->createForm(new LoginForm());

        $request = $this->get('request_stack')->getCurrentRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        if($error) {
            $this->get('alert')->addError($error->getMessage());
            $this->container->get('logger')->error('Błąd logowania. ',array($error->getMessage()));
        }

        return $this->render(
            'CmsUserBundle::login.html.twig', array(
                'form' => isset($form) ? $form->createView() : null,
                'error' => isset($error) ? $error : null
            )
        );
    }

    public function resetPasswordAction(Request $Request, $id, $given_token) {

        $form = $this->createForm(new ResetPasswordForm());
        $form->handleRequest($Request);
        $em = $this->getDoctrine()->getManager();
        $rep_user = $this->getDoctrine()->getRepository('CmsUserBundle:User');
        $rep_token = $this->getDoctrine()->getRepository('CmsUserBundle:Token');
        $user = $rep_user->find($id);
        $token = $rep_token->findOneBy(array('user_id' => $id));
        $encoder = new MessageDigestPasswordEncoder('sha512',true,100);
        $now = new \DateTime();

        if($id == null || $given_token == null || $now > $token->getExpireDate() || $token->getToken() !== $given_token) {
            $this->get('alert')->addError("Nieprawidłowe dane lub token wygasł. ");
            $this->container->get('logger')->error('Nieprawidłowe dane lub token wygasł. ',array($id, $given_token));
            $redirectURL = $this->generateUrl('login');
            return $this->redirect($redirectURL);
        } else {
                $this->get('alert')->addSuccess("Token jest prawidłowy. ");

                if($form->isValid()) {

                    $tmp_pass = $encoder->encodePassword($form->getData()['password'], '');
                    $user->setPassword($tmp_pass);
                    $em->persist($user);
                    $em->remove($token);
                    $em->flush();
                    $this->get('alert')->addSuccess("Zmiana hasła się powiodła. ");

                    $ip = $this->container->get('request')->server->get('REMOTE_ADDR');

                    $params = array(
                        'name' => $user->getUsername(),
                        'ip' => $ip
                    );
                    $mail = new Mail($user->getId(), MailTypesConstants::CHANGED_PASSWORD, json_encode($params));
                    $em->persist($mail);
                    $em->flush();

                    $this->container->get('logger')->info('Zmieniono hasło',array($id));

                    $redirectURL = $this->generateUrl('login');
                    return $this->redirect($redirectURL);

                }
        }

        return $this->render(
            'CmsUserBundle::reset-password.html.twig', array(
                'form' => isset($form) ? $form->createView() : null
            )
        );

    }

    public function generateResetPasswordLinkAction(Request $Request) {

        if (true === $this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            $redirectURL = $this->generateUrl('my_account');
            return $this->redirect($redirectURL);
        }

        $form = $this->createFormBuilder()
            ->add('email', 'email', array('label' => 'E-mail'))
            ->add('save', 'submit', array('label' => 'Wyślij instrukcje'))
            ->getForm();

        $form->handleRequest($Request);

        $em = $this->getDoctrine()->getManager();
        $rep_user = $this->getDoctrine()->getRepository('CmsUserBundle:User');
        $rep_token = $this->getDoctrine()->getRepository('CmsUserBundle:Token');

        if($form->isValid()) {

            // token ważny 30 min
            // po wygenerowaniu mail

            $user = $rep_user->findOneBy(array('email' => $form->getData()['email']));

            if($user !== null) {

                $token = $rep_token->findOneBy(array('user_id' => $user->getId()));

                if($token === null ) {
                    $now = new \DateTime();
                    $token = new Token();
                    $token->setIp($this->container->get('request')->server->get('REMOTE_ADDR'));
                    $token->setUserId($user->getId());
                    $token->setToken(substr(md5($user->getEmail()), 0, 7));
                    $token->setExpireDate($now->add(new \DateInterval('PT30M')));

                    $em->persist($token);
                    $em->flush();

                    $params = array(
                        'given_token' => $token->getToken(),
                        'id' => $user->getId(),
                        'name' => $user->getUsername(),
                        'ip' => $token->getIp()
                    );
                    $mail = new Mail($user->getId(), MailTypesConstants::PASSWORD_REMINDER, json_encode($params));
                    $em->persist($mail);
                    $em->flush();

                    $this->get('alert')->addSuccess('Instrukcja została wysłana na Twój adres email, postępuj zgodnie z nią. ');
                    $this->container->get('logger')->info('Wysłano link do resetowania hasła. ',array($user->getId()));

                    $redirectURL = $this->generateUrl('login');
                    return $this->redirect($redirectURL);

                } else {

                    $this->get('alert')->addError('Błąd. Wygenerowano już token. ');
                    $this->container->get('logger')->error('Wygnerowano już token. ',array($user->getId()));
                    $redirectURL = $this->generateUrl('login');
                    return $this->redirect($redirectURL);

                }


            } else {

                $this->get('alert')->addError('Nie ma takiego adresu e-mail');
                $this->container->get('logger')->error('Nie ma takiego adres e-mail. ',array($form->getData()['email']));

            }

        }

        return $this->render(
            'CmsUserBundle::generate-token.html.twig', array(
                'form' => isset($form) ? $form->createView() : null
            )
        );

    }
}
