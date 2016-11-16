<?php

namespace Dima\AutoTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/test/default")
     */
    public function indexAction()
    {
        return $this->render('DimaAutoTestBundle:Default:index.html.twig');
    }
}
