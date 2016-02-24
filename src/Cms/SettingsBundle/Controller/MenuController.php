<?php

namespace Cms\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cms\SettingsBundle\Entity\Menu;
use Cms\SettingsBundle\Entity\MenuItem;
use Cms\SettingsBundle\Form\NewMenuForm;
use Cms\SettingsBundle\Form\NewMenuItemForm;

class MenuController extends Controller
{

    public function addAction(Request $Request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $menu = new Menu();
        $menuItem = new MenuItem();
        $form = $this->createForm(new NewMenuForm(), $menu);
        $form->handleRequest($Request);

        $menuItemForm = $this->createForm(new NewMenuItemForm(), $menuItem);

        if ($Request->isMethod('POST')) {
            if ($form->isValid()) {

                $menu->setUserId($user->getId());

                $em->persist($menu);
                $em->flush();

                $this->get('alert')->addSuccess("Dodano poprawnie menu. ");
                $redirectURL = $this->generateUrl('my_account');
                return $this->redirect($redirectURL);

            }

        }

        return $this->render(
            "CmsSettingsBundle:Menu:add.html.twig",
            array(
                'form' => isset($form) ? $form->createView() : null,
                'menuItemForm' => isset($menuItemForm) ? $menuItemForm->createView() : null
            ));
    }

    public function addItemAction(Request $Request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $menuItem = new MenuItem();
        $form = $this->createForm(new NewMenuItemForm(), $menuItem);
        $form->handleRequest($Request);

        if ($Request->isMethod('POST')) {
            if ($form->isValid()) {

                $menu = $menuItem->getMenu();

                $menuItem->setUserId($user->getId());

                if (!empty($menu)) {
                    $menuItem->setMenu($menu->getId());
                }

                $em->persist($menuItem);
                $em->flush();

                $this->get('alert')->addSuccess("Dodano poprawnie pozycję menu. ");
                $redirectURL = $this->generateUrl('my_account');
                return $this->redirect($redirectURL);

            } else {
                var_dump($form->getData());
            }

        }

        return $this->render(
            "CmsSettingsBundle:Menu:add-item.html.twig",
            array(
                'form' => isset($form) ? $form->createView() : null
            ));
    }

}