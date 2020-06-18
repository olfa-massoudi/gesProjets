<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/equipe")
 */
class EquipeController extends AbstractController
{
    /**
     * @Route("/", name="equipe_index", methods={"GET"})
     */
    public function index(EquipeRepository $equipeRepository, Request $rq): Response
    {
         $search= new Search;
         $form = $this->createFormBuilder($search)
            ->setAction($this->generateUrl('projet_index'))
            ->setMethod('GET')
            ->add('data', TextType::class)
            ->add('filtre', ChoiceType::class, [
                        'choices' => [
                            'nom' => true,
                            'responsable' => false,
                            

                        ]])
            ->add('search', SubmitType::class, ['label' => 'OK'])

            ->getForm();
            $form->handleRequest($rq);
            $data= $form->get("data")->getData();
            $filtre= $form->get("filtre")->getData();

         if ($form->isSubmitted() && $form->isValid()) {
           if($filtre=='nom')
                $equipes = $equipeRepository->findByNom($data);
            else if ($form->filte=='responsable')
                $equipes = $equipeRepository->findResponsable($data);
            
        else 
            $equipes = $equipeRepository->findAll();
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipes ,
        ]);
    }}

    /**
     * @Route("/new", name="equipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipe);
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index');
        }

        return $this->render('equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipe_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipe $equipe): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipe_index');
        }

        return $this->render('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Equipe $equipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipe_index');
    }
}
