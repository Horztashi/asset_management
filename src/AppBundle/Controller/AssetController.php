<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Asset controller.
 *
 * @Route("asset")
 */
class AssetController extends Controller
{
    /**
     * Lists all asset entities.
     *
     * @Route("/", name="asset_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('AppBundle:Asset')->findAll();

        return $this->render('asset/index.html.twig', array(
            'assets' => $assets,
        ));
    }

    /**
     * Creates a new asset entity.
     *
     * @Route("/new", name="asset_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $asset = new Asset();
        $form = $this->createForm('AppBundle\Form\AssetType', $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                        
            $em = $this->getDoctrine()->getManager();
            
        /* Logs the creation of the Asset */
            $log = new Log($asset, "Asset was created.");
            $em->persist($log);
            $em->persist($asset);

            $em->flush();
            return $this->redirectToRoute('asset_show', array('id' => $asset->getId()));
        }

        return $this->render('generic_form_view.html.twig', array(
            'asset' => $asset,
            'title' => 'New Asset', 
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a asset entity.
     *
     * @Route("/{id}", name="asset_show")
     * @Method({"GET","POST"})
     */
    public function showAction(Asset $asset, Request $request)
    {
        $assign_form = $this->createForm('AppBundle\Form\AssetAssignType', $asset);
        $status_form = $this->createForm('AppBundle\Form\AssetStatusType', $asset);

        $assign_form->handleRequest($request);
        $status_form->handleRequest($request);

        if ($assign_form->isSubmitted() && $assign_form->isValid()) {
            $this->getDoctrine()->getManager()->persist(new Log($asset,'Asset has been assigned to ' . $asset->getUser()->getFullname() . '(' . $asset->getUser()->getEmail() . ')'));
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_show', array('id' => $asset->getId()));
        }

        if ($status_form->isSubmitted() && $status_form->isValid()) {
            $this->getDoctrine()->getManager()->persist(new Log($asset,'Asset status was changed to'. $asset->getStatus()->getName() . " Reason: " . $status_form->get('comment')->getData()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_show', array('id' => $asset->getId()));
        }             

        return $this->render('asset/show.html.twig', array(
            'asset' => $asset,
            'assign_form' => $assign_form->createView(),
            'status_form' => $status_form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing asset entity.
     *
     * @Route("/{id}/edit", name="asset_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asset $asset)
    {
        $editForm = $this->createForm('AppBundle\Form\AssetType', $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_edit', array('id' => $asset->getId()));
        }

        return $this->render('asset/edit.html.twig', array(
            'asset' => $asset,
            'edit_form' => $editForm->createView(),
        ));
    }
}
