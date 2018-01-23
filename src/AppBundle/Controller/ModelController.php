<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Model controller.
 *
 * @Route("model")
 */
class ModelController extends Controller
{
    /**
     * Lists all model entities.
     *
     * @Route("/", name="model_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $models = $em->getRepository('AppBundle:Model')->findAll();
        $model = new Model();
        $form = $this->createForm('AppBundle\Form\ModelType', $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($model);
            $em->flush();

            return $this->redirectToRoute('model_index');
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $models,
            'singular_name' => 'model',
            'plural_name' => 'models',
            'form'   => $form->createView(),
        ));

    }
    
    /**
     * Finds and displays a model entity.
     *
     * @Route("/{id}", name="model_show")
     * @Method("GET")
     */
    public function showAction(Model $model)
    {
        return $this->render('asset/index.html.twig', array(
            'assets' => $model->getAssets(),
            'item_name' => $model->getName(),
            'item_type' => "Model"
        ));

    }

    /**
     * Displays a form to edit an existing model entity.
     *
     * @Route("/{id}/edit", name="model_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Model $model)
    {
        $editForm = $this->createForm('AppBundle\Form\ModelType', $model);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('model_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Model',
            'model' => $model,
            'form' => $editForm->createView(),
        ));
    }

}
