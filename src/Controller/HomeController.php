<?php
namespace App\Controller;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
=======
use App\Repository\PropertyRepository;

>>>>>>> test/Fizioh


class HomeController extends AbstractController {
    /**
     * @Route("/"), name="home")
     * @return Response
     */
    
<<<<<<< HEAD
    public function index(){

        return $this->render('pages/home.html.twig');
=======
    public function index(PropertyRepository $repository){

        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
>>>>>>> test/Fizioh
    }
}