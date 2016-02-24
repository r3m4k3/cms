<?php

namespace Cms\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\SerializerBundle\Annotation\ExclusionPolicy;
use JMS\SerializerBundle\Annotation\Exclude;

use Cms\ContentBundle\Entity\Category;
use Cms\ContentBundle\Form\NewCategoryForm;

class CategoryController extends Controller
{

    public function addAction(Request $Request)
    {

        $em = $this->getDoctrine()->getManager();
        $rep_cities = $this->getDoctrine()->getRepository('CmsContentBundle:City');
        $user = $this->getUser();
        $category = new Category();
        $cities = $rep_cities->findAll();
        $citiesObjs = array();

        foreach($cities as $city) {
            $citiesObjs[$city->getId()] = $city->getName();
        }

        $form = $this->createForm(new NewCategoryForm($citiesObjs), $category);
        $form->handleRequest($Request);

        if ($Request->isMethod('POST')) {
            if ($form->isValid()) {

                $slug = $this->get('cocur_slugify')->slugify($category->getName());
                $superCategory = $category->getSupercategory();
                $province = $category->getProvince();
                $category->setSlug($slug);
                $category->setUserId($user->getId());

                if(!empty($superCategory)) {
                    $category->setSupercategory($superCategory->getId());
                }
                if(!empty($province)) {
                    $category->setProvince($province->getId());
                }

                $em->persist($category);
                $em->flush();

                $this->get('alert')->addSuccess("Dodano poprawnie kategorię. ");
                $redirectURL = $this->generateUrl('my_account');
                return $this->redirect($redirectURL);

            }
        }

        return $this->render(
            "CmsContentBundle:Category:add.html.twig",
            array(
                'form' => isset($form) ? $form->createView() : null
            ));
    }

    public function getCitiesByProvinceIdAction(Request $Request) {

        $results = array();
        $provinceId = $Request->request->get('provinceId');
        $rep_cities = $this->getDoctrine()->getRepository('CmsContentBundle:City');
        $cities = $rep_cities->findBy(array('province_id' => $provinceId));

        foreach($cities as $key => $city) {
            $results[$city->getId()] = $city->getName();
        }

        $serializer = $this->container->get('serializer');
        $serialized_data = $serializer->serialize($results, 'json');
        $response = new Response($serialized_data);

        return $response;

    }

}