<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
	/**
	 * Lists all product entities.
	 *
	 * @Route("/", name="product_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$products = $em->getRepository('ProductBundle:Product')->findAll();

		return $this->render('ProductBundle:Product:index.html.twig', array(
					'products' => $products,
					));
	}

	/**
	 * @Route("/view/{id}", name="product_view")
	 */
	public function viewAction($id)
	{
		$product = $this->getDoctrine()
			->getRepository('ProductBundle:Product')
			->find($id);

		if(null === $product){
			throw new \LogicException("Product not found");
		}

		return $this->render('ProductBundle:Product:view.html.twig' , [
				'product'=> $product
		]);
	}

	/**
	 * Creates a new product entity.
	 *
	 * @Route("/new", name="product_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request)
	{
		$product = new Product();
		$form = $this->createForm('ProductBundle\Form\ProductType', $product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();

			return $this->redirectToRoute('product_view', array('id' => $product->getId()));
		}

		return $this->render('ProductBundle:Product:new.html.twig', array(
					'product' => $product,
					'form' => $form->createView(),
					));
	}

	/**
	 * Displays a form to edit an existing product entity.
	 *
	 * @Route("/{id}/edit", name="product_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Product $product)
	{
		$deleteForm = $this->createDeleteForm($product);
		$editForm = $this->createForm('ProductBundle\Form\ProductType', $product);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
		}

		return $this->render('ProductBundle:Product:edit.html.twig', array(
					'product' => $product,
					'edit_form' => $editForm->createView(),
					'delete_form' => $deleteForm->createView(),
		));
	}

	/**
	 * Deletes a product entity.
	 *
	 * @Route("/{id}", name="product_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, Product $product)
	{
		$form = $this->createDeleteForm($product);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->remove($product);
			$em->flush();
		}

		return $this->redirectToRoute('product_index');
	}

	/**
	 * Creates a form to delete a product entity.
	 *
	 * @param Product $product The product entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm(Product $product)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
			->setMethod('DELETE')
			->getForm()
			;
	}
}
