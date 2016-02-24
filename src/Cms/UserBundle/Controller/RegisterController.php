<?php

namespace Cms\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\SecurityContext;

use Cms\UserBundle\Form\RegisterForm;
use Cms\UserBundle\Entity\User;
use Cms\UtilBundle\Entity\Mail;
use Cms\UtilBundle\Constant\MailTypesConstants;
//use Symfony\Component\Debug\Debug;

class RegisterController extends Controller
{

    public function indexAction(Request $Request) {

        // Debug::enable();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER') === true) {
            $redirectURL = $this->generateUrl('my_account');
            return $this->redirect($redirectURL);
        }
        $user = new User();
        $form = $this->createForm(new RegisterForm(), $user);
        $form->handleRequest($Request);

        if ($Request->isMethod('POST')) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $auth_key = substr(uniqid(md5(microtime(true))), 0, 6);
                $encoder = new MessageDigestPasswordEncoder('sha512',true,100);
                $tmp_pass = $encoder->encodePassword($user->getPassword(), '');
                $ip = $this->container->get('request')->server->get('REMOTE_ADDR');

                $user->setPassword($tmp_pass);
                $user->setIp($ip);
                $user->setAuthKey($auth_key);
                $em->persist($user);
                $em->flush();

                $params = array(
                    'auth_key' => $auth_key,
                    'id' => $user->getId(),
                    'name' => $user->getUsername()
                );
                $mail = new Mail($user->getId(), MailTypesConstants::REGISTER_USER, json_encode($params));
                $em->persist($mail);
                $em->flush();

                $this->get('alert')->addSuccess('Zarejestrowano pomyślnie.');
                $this->container->get('logger')->info('Zarejestrowano nowego użytkownika. ',array($user->getUsername(),$user->getEmail()));

                $redirectURL = $this->generateUrl('login');
                return $this->redirect($redirectURL);


            } else {
                $this->get('alert')->addError('Pobraw błędy w formularzu.');
            }
        }

        return $this->render(
            "CmsUserBundle::register.html.twig",
            array(
                'form' => isset($form) ? $form->createView() : null
            ));
    }

}
