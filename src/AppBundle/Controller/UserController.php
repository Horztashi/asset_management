<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($user->getEmployeenumber());
            $user->setPlainPassword($user->getEmployeenumber());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('generic_form_view.html.twig', array(
            'title'=> 'New User',
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method({"GET","POST"})
     */
    public function showAction(User $user, Request $request)
    {
        $assign_form = $this->createForm('AppBundle\Form\UserAssetAssignType', $user);
        $assign_form->handleRequest($request);

        if ($assign_form->isSubmitted() && $assign_form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('profile.html.twig', array(
            'user' => $user,
            'assign_form' => $assign_form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity via print.
     *
     * @Route("/{id}/print", name="user_print")
     * @Method("GET")
     */
    public function printAction(User $user)
    {
        return $this->render('user/printshow.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify User',
            'category' => $user,
            'form' => $editForm->createView(),
        ));
    }

    /**
     *
     * @Route("/{id}/status", name="user_status")
     * @Method({"GET", "POST"})
     */
    public function statusAction(Request $request, User $user)
    {

        if($user->isEnabled() && $user->getAssets()->count() > 1)
            $this->redirectToRoute('user_show', array('id' => $user->getId(),'e_message'=>'User cannot be resigned as there are assets assigned to it.'));

        $user->setEnabled(!$user->isEnabled());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_show', array('id' => $user->getId()));
    }
}
