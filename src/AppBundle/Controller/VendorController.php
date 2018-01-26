<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vendor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Vendor controller.
 *
 * @Route("vendor")
 */
class VendorController extends Controller
{
    /**
     * Lists all vendor entities.
     *
     * @Route("/", name="vendor_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $vendors = $em->getRepository('AppBundle:Vendor')->findAll();
        $vendor = new Vendor();
        $form = $this->createForm('AppBundle\Form\VendorType', $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($vendor);
            $em->flush();

            return $this->redirectToRoute('vendor_index');
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $vendors,
            'singular_name' => 'vendor',
            'plural_name' => 'vendors',
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vendor entity.
     *
     * @Route("/{id}", name="vendor_show")
     * @Method("GET")
     */
    public function showAction(Vendor $vendor)
    {
        return $this->render('asset/index.html.twig', array(
            'assets' => $vendor->getAssets(),
            'item_name' => $vendor->getName(),
            'item_type' => "Vendor"
        ));
    }

    /**
     * Displays a form to edit an existing vendor entity.
     *
     * @Route("/{id}/edit", name="vendor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Vendor $vendor)
    {
        $editForm = $this->createForm('AppBundle\Form\VendorType', $vendor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vendor_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Vendor',
            'category' => $vendor,
            'form' => $editForm->createView(),
        ));
    }

}
