<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BestController extends AbstractController
{
    /**
     * @Route("/best/{name}", name="best")
     */
    public function index($name)
    {
        return $this->render('best/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
