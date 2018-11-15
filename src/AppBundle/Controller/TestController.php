<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
	/**
	* @Route ("/test" , name="AppBundle:TestController:indexAction")
	*/
	public function indexAction(){
		return $this->render(
			'test/index.html.twig',
			[
				'nombre'=>'Juan','apellido'=>'Perez', 'productos'=>[
																	['nombre'=>'Televisor', 'precio'=>'$9000'],
																	['nombre'=>'Cafetera','precio'=> '$4500']
																	]
			]
			);
	}

}
