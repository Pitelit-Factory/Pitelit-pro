<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Repository\MotRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{


    #[Route('/', name: 'app_accueil')]
    public function accueil()
    {
        return $this->render('accueil/accueil.html.twig', ['controller_name' => 'AccueilController']);
    }
}
