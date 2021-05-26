<?php
namespace App\Controller;
<<<<<<< HEAD
=======
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
>>>>>>> test/Fizioh
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController {
    /**
<<<<<<< HEAD
=======
     * @var PropertyRepository
     */

    private $repository;
    private EntityManagerInterface $em;
    
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
>>>>>>> test/Fizioh
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(){
<<<<<<< HEAD
        return $this->render('property/index.html.twig');
=======
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string $slug) {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu' => 'properties'
        ]);
>>>>>>> test/Fizioh
    }
}