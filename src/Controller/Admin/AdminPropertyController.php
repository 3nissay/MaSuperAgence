<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PropertyType;





class AdminPropertyController extends AbstractController {
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
     
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/admin", name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }
    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request){
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien crée avec succès !');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param PropertyType $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property, Request $request){
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès !');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Property $property){
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success', 'Bien supprimé avec succès !');
        //return new Response('Suppression');
        return $this->redirectToRoute('admin.property.index');
    }
}