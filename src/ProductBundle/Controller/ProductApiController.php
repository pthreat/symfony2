<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductApiController extends Controller
{

	/**
	 *@Route("/product/api/add", name="product_api_add")
	 *@Method("POST")
	 */
	public function addAction(Request $r){
		$product = new Product();
		$form = $this->createForm(
			'ProductBundle\Form\ProductApiType',
			$product,
			[
				'csrf_protection' => false
			]
		);

		$form->bind($r);

		$valid = $form->isValid();

		$response = new Response();

		if(false === $valid){
			$response->setStatusCode(400);
			$response->setContent(json_encode($this->getFormErrors($form)));

			return $response;
		}

		if (true === $valid) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();
			$response->setContent(json_encode($product));
		}

		return $response;
	}

	public function getFormErrors($form){
		$errors = [];

		if (0 === $form->count()){
			return $errors;
		}

		foreach ($form->all() as $child) {
			if (!$child->isValid()) {
				$errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
			}
		}

		return $errors;
	}
}
