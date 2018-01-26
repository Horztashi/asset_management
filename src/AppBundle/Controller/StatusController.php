<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Status controller.
 *
 * @Route("status")
 */
class StatusController extends Controller
{
    /**
     * Lists all status entities.
     *
     * @Route("/", name="status_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $statuses = $em->getRepository('AppBundle:Status')->findAll();
        $status = new Status();
        $form = $this->createForm('AppBundle\Form\StatusType', $status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($status);
            $em->flush();

            return $this->redirectToRoute('status_index');
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $statuses,
            'singular_name' => 'status',
            'plural_name' => 'statuses',
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a status entity.
     *
     * @Route("/{id}", name="status_show")
     * @Method("GET")
     */
    public function showAction(Status $status)
    {
        return $this->render('asset/index.html.twig', array(
            'assets' => $status->getAssets(),
            'item_name' => $status->getName(),
            'item_type' => "Status"
        ));
    }

    /**
     * Displays a form to edit an existing status entity.
     *
     * @Route("/{id}/edit", name="status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Status $status)
    {
        $editForm = $this->createForm('AppBundle\Form\StatusType', $status);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('status_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Status',
            'category' => $status,
            'form' => $editForm->createView(),
        ));
    }
}