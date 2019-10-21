<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VentasController extends AbstractController
{
    /**
     * @Route("/ventas", name="app_ventas")
     */
    public function index()
    {
        return $this->render('ventas/index.html.twig', [
            'controller_name' => 'VentasController',
        ]);
    }
}
