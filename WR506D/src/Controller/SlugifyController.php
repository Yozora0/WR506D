<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Slugify;


class SlugifyController extends AbstractController
{
    #[Route('/slugify', name: 'app_slugify')]
    public function slugify(Slugify $slugify): Response
    {
        $slug = new Slugify();
        $slug = $slug->slugify('Ceci est un test');
        return $this->render(
            'slugify/index.html.twig',
            [
                'slug' => $slug,
            ]
        );
    }






}
