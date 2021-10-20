<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\NouvelleAnnonceType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController{
    
    
    /**
     * @Route("/article", name="contact_index")
     * 
     */
    public function index(ContactRepository $repo)
    {
        $contacts=$repo->findAll();

        return $this->render('home/liste.html.twig', [
            'contacts' => $contacts,
        ]);
    }


    /**
     * Pertmet de créer une annonce
     *
     * @Route("/contact/new", name="contact_create")
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){
        $contact= new Contact(); 

        $form= $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //$manager= $this->getDoctrine()->getManager(); On récupère le manager en haut directement dans la fonction

            $manager->persist($contact);
            $manager->flush();


            $this->addFlash(
                'success',
                "Votre contact appellé <strong>{$contact->getNom()}</strong> a bien été enregistrée."
            );


            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }


        return $this->render('home/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet de supprimé un article
     *
     * @Route("/contact/delete/{id}", name="contact_delete")
     * 
     */
    public function delete(Contact $contact,EntityManagerInterface $manager)
    {
        
        $manager->remove($contact);
        $manager->flush();

        $this->addFlash(
            'success',
            "le contact a bien été supprimée");

        return $this->redirectToRoute("contact_index");
    }

    /**
     * Permet d'afficher une seul annonce
     *
     * @Route("/contact/{id}", name="contact_show")
     * 
     * @return Response
     */
    public function show(Contact $contact)
    {
        return $this->render('home/show.html.twig',[
            'contact' => $contact
        ]);
    }
}