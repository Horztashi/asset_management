<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Location controller.
 *
 * @Route("location")
 */
class LocationController extends Controller
{
    /**
     * Lists all location entities.
     *
     * @Route("/", name="location_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        $location = new Location();
        $form = $this->createForm('AppBundle\Form\LocationType', $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_index');
        }

        return $this->render('generic_index.html.twig', array(
            'items' => $locations,
            'singular_name' => 'location',
            'plural_name' => 'locations',
            'form'   => $form->createView(),
        ));
    }
    
    /**
     * Finds and displays a location entity.
     *
     * @Route("/{id}", name="location_show")
     * @Method("GET")
     */
    public function showAction(Location $location)
    {
        return $this->render('asset/index.html.twig', array(
            'assets' => $location->getAssets(),
            'item_name' => $location->getName(),
            'item_type' => "Location"
        ));
    }

    /**
     * Displays a form to edit an existing location entity.
     *
     * @Route("/{id}/edit", name="location_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Location $location)
    {
        $editForm = $this->createForm('AppBundle\Form\LocationType', $location);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Location',
            'location' => $location,
            'form' => $editForm->createView(),
        ));
    }

}
