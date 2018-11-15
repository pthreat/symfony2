<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as sfController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends sfController
{
    /**
     * @Route("/" , name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }
    /**
     * @Route("/test/{id}", name="testpage")
     */
    public function textAction($id)
    {
        var_dump($id);
        die();
    }
}
