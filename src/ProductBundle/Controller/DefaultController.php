<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/products/list", name="listOfProducts")
     */
    public function indexAction()
    {
        if(isset($_GET['busqueda']))
        {
            $busqueda = $_GET['busqueda'];
            $repository = $this->getDoctrine()
                ->getRepository('ProductBundle:Product');

            $query = $repository->createQueryBuilder('p')
                ->where('p.name LIKE :nombre')
                ->setParameter('nombre', '%'.$busqueda.'%')
                ->orderBy('p.name', 'ASC')
                ->getQuery();
            $products = $query->getResult();
        }else
        {
    	   $products = $this->getDoctrine()
		    	 ->getRepository('ProductBundle:Product')
		    	 ->findAll();
        }
    	return $this->render('ProductBundle:Default:index.html.twig' ,['products'=> $products]);
    }
    
}
