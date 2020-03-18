<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class ProxidejController extends AbstractController
{
    /**
     * @Route("/",name="proxidej_homepage")
     *
     */
    public function homepage(){
        return $this->render('index.html.twig');
    }
    /**
     * @Route("/connexion",name="proxidej_connexion")
     */
    public function connexion(){
        return $this->render('connexion.html.twig');
    }

    /**
     * @Route("/suivie-livraisons",name="proxidej_livraisons")
     */
    public function livraison(){
        return $this->render('suivieLivraison.html.twig');
    }

    /**
     * @Route("/chambre-froide",name="proxidej_chambre")
     */
    public function chambre(){
        return $this->render('chambre.html.twig');
    }

    /**
     * @Route("/historique",name="proxidej_historique")
     */
    public function historique(){
        return $this->render('historique.html.twig');
    }


    /**
     * @Route("{slug}")
     */
    public function show($slug)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];
        return $this->render('connexion.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
        ]);
    }

}