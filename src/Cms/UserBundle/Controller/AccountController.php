<?php

namespace Cms\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Validator\Constraints as Assert;

use Cms\UserBundle\Form\AvatarForm;
use Cms\UserBundle\Form\NewPasswordForm;
use Cms\UserBundle\Form\EditAccountForm;
use Cms\UtilBundle\Entity\Mail;
use Cms\UtilBundle\Constant\GlobalConstants;
use Cms\UtilBundle\Constant\MailTypesConstants;

class AccountController extends Controller
{

    public function indexAction(Request $Request)
    {

//        if ($this->get('security.authorization_checker')->isGranted('ROLE_DESIGNER') === true) {
//            echo 'designer';
//        }
//
//        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER') === true) {
//            echo 'user';
//        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(new AvatarForm());

        if($user->getActivated() === null)
            $this->get('alert')->addError("Jeśli chcesz zatrzymać konto, musisz je aktywować. Masz na to 72 godziny od rejestracji. ");

        $form->handleRequest($Request);
        $dir = GlobalConstants::UPLOAD_DIR.'images/avatars/';

        $this->container->get('logger')->info('Zalogowano poprawnie. ',array($user->getId()));

        if($form->isValid()) {

            $file = $form->getData()['avatar'];
            $filename = date('dmYHis').'_'.md5($user->getUsername()).'.png';
            $user->setAvatar($filename);
            $em->persist($user);
            $em->flush();

            $file->move($dir, $filename);

            $this->container->get('logger')->info('Zmieniono avatar. ',array($user->getId()));

            $redirectURL = $this->generateUrl('my_account');
            return $this->redirect($redirectURL);

        }

        return $this->render(
            'CmsUserBundle::account-details.html.twig',
            array(
                'user' => $user,
                'form' => isset($form) ? $form->createView() : null
            )
        );
    }

    public function editAction(Request $Request) {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(new EditAccountForm(), $user);
        $form->handleRequest($Request);

        if($form->isValid()) {

            $em->persist($user);
            $em->flush();

            $this->get('alert')->addSuccess("Zmiany zostały zapisane. ");
            $this->container->get('logger')->info('Zmieniono dane konta. ',array($user->getId()));
            $redirectURL = $this->generateUrl('my_account');
            return $this->redirect($redirectURL);

        }

        return $this->render(
            'CmsUserBundle::edit-account-details.html.twig',
            array(
                'form' => isset($form) ? $form->createView() : null
            )
        );

    }

    public function changePasswordAction(Request $Request) {

        $form = $this->createForm(new NewPasswordForm());
        $form->handleRequest($Request);
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $encoder = new MessageDigestPasswordEncoder('sha512',true,100);

        if($form->isValid()) {

            $old_password = $encoder->encodePassword($form->getData()['old-password'], '');
            $new_password = $encoder->encodePassword($form->getData()['new-password'], '');

            if($user->getPassword() === $old_password) {

                $user->setPassword($new_password);
                $em->persist($user);
                $em->flush();
                $this->get('alert')->addSuccess("Zmiana hasła się powiodła. ");
                $this->container->get('logger')->info('Zmieniono hasła. ',array($user->getId()));
                $redirectURL = $this->generateUrl('login');
                return $this->redirect($redirectURL);

            } else {
                $this->get('alert')->addError("Wpisane hasło jest błędne. Wpisz poprawne i spróbuj jeszcze raz. ");
                $this->container->get('logger')->info('Wpisane hasło jest błędne. ',array($user->getId()));
            }

        }

        return $this->render(
            'CmsUserBundle::change-password.html.twig', array(
                'form' => isset($form) ? $form->createView() : null
            )
        );

    }

    public function activateAction($id, $auth_key) {

        $em = $this->getDoctrine()->getManager();
        $rep_user = $this->getDoctrine()->getRepository('CmsUserBundle:User');
        $user = $rep_user->find($id);
        $my_auth_key = $user->getAuthKey();
        $activation_date = $user->getActivated();

        if($my_auth_key === $auth_key && $activation_date === null) {
            $user->setActivated(new \DateTime());
            $user->setAuthKey(null);
            $em->persist($user);
            $em->flush();
            $this->get('alert')->addSuccess("Konto aktywowano pomyślnie. ");
            $this->container->get('logger')->info('Konto zostało aktywowane pomyślnie. ',array($id, $auth_key));
        } else if($activation_date !== null) {
            $this->get('alert')->addWarning("Konto zostało już aktywowane. ");
            $this->container->get('logger')->info('Konto zostało już aktywowane. ',array($id, $auth_key));
        } else {
            $this->get('alert')->addError("Błąd aktywacji. ");
            $this->container->get('logger')->error('Błąd aktywacji. ',array($id, $auth_key));
        }

        $redirectURL = $this->generateUrl('login');
        return $this->redirect($redirectURL);

    }

    public function resendActivationLinkAction() {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $params = array(
            'auth_key' => $user->getAuthKey(),
            'id' => $user->getId(),
            'name' => $user->getUsername()
        );
        $mail = new Mail($user->getId(), MailTypesConstants::ACTIVATE_ACCOUNT, json_encode($params));
        $em->persist($mail);
        $em->flush();

        $this->get('alert')->addSuccess('Wysłano ponownie link z kodem aktywacyjnym.');
        $this->container->get('logger')->info('Wysłano ponownie link aktywacyjny. ',array($user->getId()));

        $redirectURL = $this->generateUrl('my_account');
        return $this->redirect($redirectURL);

    }
}
