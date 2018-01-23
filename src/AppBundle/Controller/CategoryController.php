<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 * @Route("category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAll();
        $category   = new Category();
        $form = $this->createForm('AppBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_index');
        }
        return $this->render('generic_index.html.twig', array(
            'items' => $categories,
            'singular_name' => 'category',
            'plural_name' => 'categories',
            'form'   => $form->createView(),
        ));    
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(Category $category)
    {
        return $this->render('asset/index.html.twig', array(
            'assets' => $category->getAssets(),
            'item_name' => $category->getName(),
            'item_type' => "Category"
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $editForm = $this->createForm('AppBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render('generic_form_view.html.twig', array(
            'title' => 'Modify Category',
            'category' => $category,
            'form' => $editForm->createView(),
        ));
    }

}
