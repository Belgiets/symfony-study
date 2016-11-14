<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends Controller
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function indexAction($name, Request $request)
    {
        $page = $request->query->get('page', 1);

        return new Response(
            "<html><body><p>Hello {$name}!</p><p>{$page}</p></body></html>"
        );
    }

    /**
     * @Route("/redirect", name="redirect")
     */
    public function redirectAction()
    {
        return $this->redirect('http://symfony.com');
    }

    /**
     * @Route("/showflash", name="showflash")
     */
    public function flashAction()
    {
        $this->addFlash(
            'notice',
            'This is some notice'
        );

        return $this->render('@App/hello/hello.html.twig');
    }
}
