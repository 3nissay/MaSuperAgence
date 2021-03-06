<?php
namespace App\Controller;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;


class HomeController extends AbstractController {
    /**
     * @Route("/"), name="home")
     * @return Response
     */
    
    public function index(PropertyRepository $repository){

        $properties = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
}