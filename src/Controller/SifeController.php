<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SifeController extends AbstractController
{
    /**
     * @Route("/homepage", name="sife_homepage")
     */
    public function index()
    {
        return $this->render('sife/index.html.twig', [
            'controller_name' => 'SifeController',
        ]);
    }
}
