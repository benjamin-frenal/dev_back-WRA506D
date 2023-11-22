<?php

namespace App\Controller;

use App\Services\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route("/products", name: "list_products")]
    public function listProducts(): Response
    {
        return $this->render('product/list.html.twig', [
            'title' => 'Liste des produits',
        ]);
    }

    #[Route("/product/slug", name: "app_product_slug")]
    public function slugProducts(
        Slugify $slugify,
    ): Response {
        $texte = $slugify->generateSlug('Ceci est une phrase en français');
        dd($texte); //Deboogger

        return $this->render('product/slugProducts', [
        ]);
    }

    #[Route("/product/{id}", name: "view_product")]
    public function viewProduct($id): Response
    {
        return $this->render('product/view.html.twig', [
            'title' => "Affichage du produit $id",
            'productId' => $id,
        ]);
    }
}
