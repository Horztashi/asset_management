<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Brand controller.
 *
 * @Route("brand")
 */
class BrandController extends Controller
{
    /**
     * Lists all brand entities.
     *
     * @Route("/", name="brand_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $brands = $em->getRepository('AppBundle:Brand')->findAll();
        $brand = new Brand();
        $form = $this->createForm('AppBundle\Form\BrandType', $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($brand);
            $em->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $brands,
            'singular_name' => 'brand',
            'plural_name' => 'brands',
            'form'   => $form->createView(),
        ));

    }
    
    /**
     * Finds and displays a brand entity.
     *
     * @Route("/{id}", name="brand_show")
     * @Method({"GET","POST"})
     */
    public function showAction(Brand $brand, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $model = new Model();
        $form = $this->createForm('AppBundle\Form\ModelType', $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($model);
            $em->flush();
            return $this->redirectToRoute('brand_show', array('id'=>$brand->getId()));
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $brand->getModels(),
            'singular_name' => 'model',
            'plural_name' => 'models',
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing brand entity.
     *
     * @Route("/{id}/edit", name="brand_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Brand $brand)
    {
        $editForm = $this->createForm('AppBundle\Form\BrandType', $brand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Brand',
            'brand' => $brand,
            'form' => $editForm->createView(),
        ));
    }

}
