<?php
namespace App\Controller;
use Twig\Environnement;
use Symfony\Component\HttpFoundation\Response;

class HomeController {
    /**
     * * @var Environnement
     */
    private $twig;

    public function __construct($twig){
        $this->twig = $twig;
    }
    
    public function index(){

        return new Response($this->twig->render('pages/home.html.twig'));
    }
}