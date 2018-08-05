<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Asset;
use AppBundle\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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

        if($this->isGranted('ROLE_ADMIN'))
        $assets = $em->getRepository('AppBundle:Asset')->findAll();
        else
        $assets = $em->getRepository('AppBundle:Asset')->findByUser($this->getUser());
            
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
            $log = new Log($asset, "Asset was created.", $this->getUser());
            $asset->setStatus($em->getRepository('AppBundle:Status')->findOneById(1));

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

        if(!$this->isGranted('ROLE_ADMIN') 
            AND $asset->getUser()!= $this->getUser())
            throw new AccessDeniedException();

        $assign_form = $this->createForm('AppBundle\Form\AssetUserAssignType', $asset);
        $status_form = $this->createForm('AppBundle\Form\AssetStatusType', $asset);

        $assign_form->handleRequest($request);
        $status_form->handleRequest($request);

        if ($assign_form->isSubmitted() && $assign_form->isValid()) {
            $custodians = "";

            foreach($asset->getUsers() as $user)
                $custodians = $custodians . " ," . $user->getFullname() . "(". $user->getEmail() .")";

            $this->getDoctrine()->getManager()->persist(new Log($asset,'Asset  was assigned to '. $custodians . ".",$this->getUser()));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_show', array('id' => $asset->getId()));
        } 

        if ($status_form->isSubmitted() && $status_form->isValid()) {
            $this->getDoctrine()->getManager()->persist(new Log($asset,'Asset status was changed to '. $asset->getStatus()->getName() . " Reason: " . $status_form->get('comment')->getData(),$this->getUser()));

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

            return $this->redirectToRoute('asset_show', array('id' => $asset->getId()));
        }

        return $this->render('asset/edit.html.twig', array(
            'asset' => $asset,
            'form' => $editForm->createView(),
            'title' => 'Edit asset'
        ));
    }

    /**
     * Lists all asset entities.
     *
     * @Route("/unassign/", name="asset_unassign")
     * @Method("GET")
     */
    public function unassignAction()
    {
        $em = $this->getDoctrine()->getManager();
        $assets = $em->getRepository('AppBundle:Asset')->findAssetsWithoutUser();
            
        return $this->render('asset/index_unassigned_list.html.twig', array(
            'assets' => $assets,
        ));
    }

    /**
     * Deletes the selected Asset.
     *
     * @Route("/{id}/delete", name="asset_delete")
     * @Method("GET")
     */
    public function deleteAction(Asset $asset)
    {
        $em = $this->getDoctrine()->getManager();
            $em->remove($asset);
            $em->flush();

        return $this->redirectToRoute('asset_index');
    }

    /**
     * Lists all asset entities.
     *
     * @Route("/api/asset_list", name="api_asset_list")
     * @Method("GET")
     */
    public function jsonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $assets = $em->getRepository('AppBundle:Asset')->findAll();

        $assetjson = array();
        foreach($assets as $asset)
            $assetsjson[] = array('id' => $asset->getId(), 'code'=> $asset->getCode());



        $response = new Response();
//        $response->setContent(json_encode($assetsjson));
        $response->setContent('[{id:1,code:"LOL"}]');
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
