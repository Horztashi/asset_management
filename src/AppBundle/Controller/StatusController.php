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

        return $this->render('status/index.html.twig', array(
            'statuses' => $statuses,
            'form' => $form->createView(),
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
        $deleteForm = $this->createDeleteForm($status);

        $repository = $this->getDoctrine()->getRepository(Status::class);
        $statuses   = $repository->findAll();

        return $this->render('status/show.html.twig', array(
            'status' => $status,
            'statuses' => $statuses,
            'delete_form' => $deleteForm->createView(),
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
        $deleteForm = $this->createDeleteForm($status);
        $editForm = $this->createForm('AppBundle\Form\StatusType', $status);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('status_edit', array('id' => $status->getId()));
        }

        return $this->render('status/edit.html.twig', array(
            'status' => $status,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a status entity.
     *
     * @Route("/{id}", name="status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Status $status)
    {
        $form = $this->createDeleteForm($status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($status);
            $em->flush();
        }

        return $this->redirectToRoute('status_index');
    }

    /**
     * Creates a form to delete a status entity.
     *
     * @param Status $status The status entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Status $status)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('status_delete', array('id' => $status->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}