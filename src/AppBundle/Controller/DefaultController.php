<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/create-product", name="create_product")
     */
    public function createAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relate this product to the category
        $product->setCategory($category);
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

    /**
     * @Route("/show-product/{productId}", name="show_product")
     */
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($productId);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }
        return new Response(
            "<p>id - ".$product->getId()."</p><p>name - ".$product->getName()."</p>"
        );
    }

    /**
     * @Route("/update-product/{productId}", name="update_product")
     */
    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($productId);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }
        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('show_product', ['productId' => $productId]);
    }

    /**
     * @Route("/show-products", name="show_products")
     */
    public function showProductsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findAllOrderedByName();

        if (!$products) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }
        return new Response(
            "<p>We have ". count($products) ." products</p>"
        );
    }
}
