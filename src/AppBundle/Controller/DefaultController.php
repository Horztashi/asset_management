<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Asset;
use AppBundle\Entity\Status;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager();

        // All Assets
        $allAssets          = count($em->getRepository('AppBundle:Asset')->findAll());

        // None Defective Assets vs. Defective Assets
        $defectiveAssets    = count($em->getRepository('AppBundle:Asset')->findByStatus(2));
        $notDefectiveAssets = $allAssets - $defectiveAssets;     

        // Critical vs Non-Critical Assets
        $criticalAssets     = count($em->getRepository('AppBundle:Asset')->findByIsCritical(true));
        $noncriticalAssets  = count($em->getRepository('AppBundle:Asset')->findByIsCritical(false));

        // Assigned vs Unassigned Assets
        $unassignedAssets   = count($em->getRepository('AppBundle:Asset')->findByUser(null));
        $assignedAssets     = $allAssets - $unassignedAssets;

        // Asset Per Category
        $categories         = $em->getRepository('AppBundle:Category')->findAll();
        $categoriesArray    = array();

        foreach($categories as $category){
            $categoryName   = $category->getName();
            $assetCount     = count($em->getRepository('AppBundle:Asset')->findByCategory($category));
            $categoriesArray[] = array('name' => $categoryName, 'count' => $assetCount);
        }

        // Assets per Status
        $statuses           = $em->getRepository('AppBundle:Status')->findAll();
        $statusesArray      = array();

        foreach($statuses as $status){
            $statusName     = $status->getName();
            $assetCount     = count($em->getRepository('AppBundle:Asset')->findByStatus($status));
            $statusesArray[] = array('name' => $statusName, 'count' => $assetCount);
        }

        // For Disposal
        $disposalAssets   = count($em->getRepository('AppBundle:Asset')->findByStatus(3));

        // Monthly: New Assets
        $mNewAssets         = count($em->getRepository('AppBundle:Log')->findByType('N'));

        // Monthly: Changed Custodian
        $mAssigned         = count($em->getRepository('AppBundle:Log')->findByType('A'));
        // Monthly: Changed Status
        $mStatus         = count($em->getRepository('AppBundle:Log')->findByType('S'));

        // Upcoming Maintenance
        $upcomingMaintenance = $em->getRepository('AppBundle:Maintenance')->findByScheduleGreaterThanWithLimit(new \Datetime,3);

        return $this->render('index.html.twig',array(
                            'notDefectiveAssets' => $notDefectiveAssets,
                            'defectiveAssets' => $defectiveAssets,
                            'criticalAssets' => $criticalAssets,
                            'noncriticalAssets' => $noncriticalAssets,
                            'unassignedAssets' => $unassignedAssets,
                            'assignedAssets' => $assignedAssets,
                            'categoriesArray' => $categoriesArray,
                            'statusesArray' => $statusesArray,
                            'disposalAssets' => $disposalAssets,
                            'mNewAssets' => $mNewAssets,
                            'mAssigned' => $mAssigned,
                            'mStatus' => $mStatus,
                            'upcomingMaintenance' => $upcomingMaintenance,
                            
                        ));
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('profile.html.twig');
    }

    /**
     * @Route("/profileprint", name="profile_print")
     */
    public function profilePrintAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('AppBundle:Asset')->findByUser($this->getUser());


        return $this->render('user/printshow.html.twig',array('assets'=>$assets));
    }
}
