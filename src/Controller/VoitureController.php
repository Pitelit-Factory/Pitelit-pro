<?php

namespace App\Controller;
use App\Entity\Voiture;
use App\Form\UpdateVoitureType;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt\ElseIf_;
use Proxies\__CG__\App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Exception\ValidatorException;
use TheSeer\Tokenizer\Exception;

class VoitureController extends AbstractController
{
    #[Route('/voitures', name: 'app_voitures')]
    public function allVoitures(VoitureRepository $repo)
    {
        $voitures = $repo->findBy([
            'user' => $this->getUser()
        ]);
        
        
        return $this->render('voiture/allVoiture.html.twig', [
            'voitures' => $voitures
        ]);
    }

    #[Route('/addVoitures', name: 'app_add_voiture')]
    public function addVoitures(Request $request, EntityManagerInterface $manager, VoitureRepository $repo): Response
    {
        $voiture = new Voiture;
        $user = $this->getUser();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() and $form->isValid()) {
            $voiture->setUser($user);
            $format = 'd/m/Y';
            $date = $voiture->getAnnee();
            
            $manager->persist($voiture);
            $manager->flush();
            $this->addFlash(
                'notice',
                'Le véhicule à bien été rajoutée'
            );
            
        }
         $voiture = new Voiture;
         $form = $this->createForm(VoitureType::class, $voiture);

        return $this->render('voiture/addVoiture.html.twig', [
            'VoitureType' => $form->createView(),
        ]);
    }

    /**
     * Summary of deleteVoiture
     * @param VoitureRepository $repo
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */

    #[Route('deleteVoiture/{id}', name: 'delete_voiture')]
    public function deleteVoiture(VoitureRepository $repo,ManagerRegistry $doctrine, int $id){
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Voiture::class)->find($id);
        $entityManager->remove($product);
        $entityManager->flush();    
        return $this->redirectToRoute('app_voitures');
    }

    #[Route('/update/voiture/{id}', name: 'update_voiture')]
    public function updateVoiture(VoitureRepository $repo, ManagerRegistry $doctrine,Request $request, int $id,EntityManagerInterface $manager ){
        $entityManager = $doctrine->getManager();
        $voiture = $entityManager->getRepository(Voiture::class)->find($id);
        $form = $this->createForm(UpdateVoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $manager->persist($voiture);
            $manager->flush();
            return $this->redirectToRoute('app_voitures');
        }
        return $this->render('/voiture/updateVoiture.html.twig', [
            'UpdateVoitureType' => $form->createView(), 'voiture' => $voiture
        ]);

    }

}
