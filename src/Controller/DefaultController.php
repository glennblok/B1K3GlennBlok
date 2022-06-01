<?php

namespace App\Controller;

use App\Entity\Bedrijf;
use App\Form\Bedrijf1Type;
use App\Repository\BedrijfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default', methods: ['GET'])]
    public function index(BedrijfRepository $bedrijfRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'bedrijfs' => $bedrijfRepository->findAll(),
        ]);
    }

}
