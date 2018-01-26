<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('asset_index');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assets = $em->getRepository('AppBundle:Asset')->findByUser($this->getUser());


        return $this->render('profile.html.twig',array('assets'=>$assets));
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
