<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projet", name="projet")
     */
    public function index()
    { 
    	$projets= $this->getDoctrine()
        ->getRepository(Projet::class)
        ->findAll();

        return $this->render('projet/index.html.twig', [
          "projets" => $projets
        ]);

    }
     /**
     * @Route("/projet/{id}, name="projet_show"")
     */
    public function show($id)
    {
    	$projet= $this->getDoctrine()
        ->getRepository(Projet::class)
        ->find($id);
        return $this->render('projet/show.html.twig';[
        	"projet"=>$projet
        ]);
    }
}
