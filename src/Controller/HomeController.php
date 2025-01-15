<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PizzaRepository $repository): Response
    {
        // Requête READ 
        $pizza = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'pizzas' => $pizza, //Envoie de la requête en VUE 
        ]);
    }
}
