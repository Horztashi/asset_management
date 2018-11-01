<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Maintenance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Maintenance controller.
 *
 * @Route("maintenance")
 */
class MaintenanceController extends Controller
{
    /**
     * Lists all maintenance entities.
     *
     * @Route("/", name="maintenance_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $maintenance = new Maintenance();
        $form = $this->createForm('AppBundle\Form\MaintenanceType', $maintenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($maintenance);
            $em->flush();

            return $this->redirectToRoute('maintenance_index');
        }

        $maintenances = $em->getRepository('AppBundle:Maintenance')->findAll();

        return $this->render('maintenance/index.html.twig', array(
            'maintenance' => $maintenance,
            'maintenances' => $maintenances,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a maintenance entity.
     *
     * @Route("/{id}", name="maintenance_show")
     * @Method("GET")
     */
    public function showAction(Maintenance $maintenance)
    {
        return $this->render('maintenance/show.html.twig', array(
            'maintenance' => $maintenance,
        ));
    }

    /**
     * Displays a form to edit an existing maintenance entity.
     *
     * @Route("/{id}/edit", name="maintenance_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Maintenance $maintenance)
    {
        $editForm = $this->createForm('AppBundle\Form\MaintenanceType', $maintenance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maintenance_show', array('id' => $maintenance->getId()));
        }

        return $this->render('maintenance/edit.html.twig', array(
            'maintenance' => $maintenance,
            'form' => $editForm->createView(),
            'title' => 'Maintenance Update'
        ));
    }

    /**
     * Displays a form to edit an existing maintenance entity.
     *
     * @Route("/{id}/done", name="maintenance_done")
     * @Method("GET")
     */
    public function doneAction(Maintenance $maintenance)
    {
        if($maintenance->getActual() == null)
        {
            $em = $this->getDoctrine()->getManager();
            $maintenance->setActual(new \DateTime());
            $em->flush();
        }
        return $this->redirectToRoute('maintenance_index');
    }

    /**
     * Deletes the selected Maintenance.
     *
     * @Route("/{id}/delete", name="maintenance_delete")
     * @Method("GET")
     */
    public function deleteAction(Maintenance $maintenance)
    {
        $em = $this->getDoctrine()->getManager();
            $em->remove($maintenance);
        $em->flush();

        return $this->redirectToRoute('maintenance_index');
    }
}
