<?php

namespace Cms\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Cms\ContentBundle\Entity\News;
use Cms\ContentBundle\Form\NewNewsForm;

class NewsController extends Controller
{

    public function addAction(Request $Request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $news = new News();
        $form = $this->createForm(new NewNewsForm(), $news);
        $form->handleRequest($Request);

        if ($Request->isMethod('POST')) {
            if ($form->isValid()) {

                $slug = $this->get('cocur_slugify')->slugify($news->getTitle());
                $category = $news->getCategory();
                $news->setSlug($slug);
                $news->setUserId($user->getId());
                $news->setCategory($category->getId());

                $em->persist($news);
                $em->flush();

                $this->get('alert')->addSuccess("Dodano poprawnie aktualność. ");
                $redirectURL = $this->generateUrl('my_account');
                return $this->redirect($redirectURL);

            }
        }

        return $this->render(
            "CmsContentBundle:News:add.html.twig",
            array(
                'form' => isset($form) ? $form->createView() : null
            ));
    }

    public function getListAction()
    {

        $rep_news = $this->getDoctrine()->getRepository('CmsContentBundle:News');
        $news = $rep_news->findAll();


        return $this->render(
            "CmsContentBundle:News:list.html.twig",
            array(
                'news' => isset($news) ? $news : null
            ));
    }

}