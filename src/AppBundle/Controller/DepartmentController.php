<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Department controller.
 *
 * @Route("department")
 */
class DepartmentController extends Controller
{
    /**
     * Lists all department entities.
     *
     * @Route("/", name="department_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $departments = $em->getRepository('AppBundle:Department')->findAll();
        $department = new Department();
        $form = $this->createForm('AppBundle\Form\DepartmentType', $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($department);
            $em->flush();

            return $this->redirectToRoute('department_index');
        }

            return $this->render('generic_index.html.twig', array(
            'items' => $departments,
            'singular_name' => 'department',
            'plural_name' => 'departments',
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a department entity.
     *
     * @Route("/{id}", name="department_show")
     * @Method("GET")
     */
    public function showAction(Department $department)
    {
        return $this->render('department/index.html.twig', array(
            'assets' => $department->getAssets(),
            'item_name' => $department->getName(),
            'item_type' => "Department"
        ));
    }

    /**
     * Displays a form to edit an existing department entity.
     *
     * @Route("/{id}/edit", name="department_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Department $department)
    {
        $editForm = $this->createForm('AppBundle\Form\DepartmentType', $department);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('department_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Department',
            'department' => $department,
            'form' => $editForm->createView(),
        ));
    }
}
