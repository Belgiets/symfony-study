<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class LuckyController
 * @package AppBundle\Controller
 */
class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count)
    {
        $numbers = [];

        for ($i = 1; $i <= $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        return new Response(
            "<html><body><div class='symf-container'>{$numbersList}</div></body></html>"
        );
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = [rand(0, 100)];

        return new JsonResponse($data);
    }
}
