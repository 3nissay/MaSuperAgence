<?php
namespace App\Controller\Admin;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PropertyType;



class AdminPropertyController extends AbstractController {
    /**
     * @var PropertyRepository
     */

    private $repository;
     
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
     * @Route("/admin/{id}", name="admin.property.edit")
     * @param PropertyType $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property, Request $request){
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    }
}