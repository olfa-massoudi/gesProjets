<?php
namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Categorie;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Search;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/projet")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="projet_index", methods={"GET","POST"})
     */
    
    public function index(ProjetRepository $projetRepository, Request $rq): Response

    {   
        $nb= $this->getDoctrine()->getManager()
        ->createQuery('SELECT COUNT(c.id) FROM App\Entity\Categorie c')
        ->getSingleScalarResult();

        $search= new Search;
         $form = $this->createFormBuilder($search)
            ->setAction($this->generateUrl('projet_index'))
            ->setMethod('GET')
            ->add('data', TextType::class)
            ->add('filtre', ChoiceType::class, [
                        'choices' => [
                            'nom' => true,
                            'date_debut' => false,
                            'date_fin' => false,

                        ]])
            ->add('search', SubmitType::class, ['label' => 'OK'])

            ->getForm();
            $form->handleRequest($rq);
            $data= $form->get("data")->getData();
            $filtre= $form->get("filtre")->getData();

        if ($form->isSubmitted() && $form->isValid()) {
           if($filtre=='nom')
                $projets = $projetRepository->findByNom($data);
            else if ($form->filte=='date_debut')
                $projets = $projetRepository->findByDateDebut($data);
            else
                $projets = $projetRepository->findByDateFin($data);}
            
        else 
            $projets = $projetRepository->findAll();

        return $this->render('projet/index.html.twig', [
            
            'projets' => $projets,
            'categorie_cnt'=> $nb,
            "form"=>$form->createView(),


                    # code...
                
                # code...
            
        ]);
    }

    /**
     * @Route("/new", name="projet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projet_index');
        }

        return $this->render('projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projet_show", methods={"GET"})
     */
    public function show(Projet $projet): Response
    {
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="projet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projet $projet): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projet_index');
        }

        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Projet $projet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projet_index');
    }
}
