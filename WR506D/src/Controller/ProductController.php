<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
      #[Route("/products", name:"product_list")]

    public function listProducts(): Response
    {
        return $this->render('product/list.html.twig', [
            'pageTitle' => 'Liste des produits',
        ]);
    }

    #[Route("/product/{id}", name:"product_view")]

    public function viewProduct(Request $request): Response
    {
        $id = $request->query->get('id');

        return $this->render('product/view.html.twig', [
            'pageTitle' => 'Affichage du produit ' . $id,
        ]);
    }
}
