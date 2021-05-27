<?php
namespace App\Controller\Admin;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PropertyType;



class AdminPropertyController extends AbstractController {
    /**
     * @var PropertyRepository
     */

    private $repository;
    
    public function __construct(PropertyRepository $repository){
        $this->repository = $repository;
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Property $property){
        $form = $this->createForm(PropertyType::class, $property);
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property, 
            'form' => $form->createView()
        ]);
    }
}