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

#[Route('/bedrijf')]
class BedrijfController extends AbstractController
{
    #[Route('/', name: 'bedrijf_index', methods: ['GET'])]
    public function index(BedrijfRepository $bedrijfRepository): Response
    {
        return $this->render('bedrijf/index.html.twig', [
            'bedrijfs' => $bedrijfRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'bedrijf_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bedrijf = new Bedrijf();
        $form = $this->createForm(Bedrijf1Type::class, $bedrijf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bedrijf);
            $entityManager->flush();

            return $this->redirectToRoute('bedrijf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bedrijf/new.html.twig', [
            'bedrijf' => $bedrijf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bedrijf_show', methods: ['GET'])]
    public function show(Bedrijf $bedrijf): Response
    {
        return $this->render('bedrijf/show.html.twig', [
            'bedrijf' => $bedrijf,
        ]);
    }

    #[Route('/{id}/edit', name: 'bedrijf_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bedrijf $bedrijf, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Bedrijf1Type::class, $bedrijf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bedrijf_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bedrijf/edit.html.twig', [
            'bedrijf' => $bedrijf,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bedrijf_delete', methods: ['POST'])]
    public function delete(Request $request, Bedrijf $bedrijf, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bedrijf->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bedrijf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bedrijf_index', [], Response::HTTP_SEE_OTHER);
    }
}
