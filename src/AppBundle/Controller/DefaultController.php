<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('front/home_page.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/page2", name="page2")
     */
    public function page2Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('front/page2.html.twig', [
            'username' => 'Henri',
        ]);
    }

}



