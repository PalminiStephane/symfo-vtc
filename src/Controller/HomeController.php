<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\DriverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(CarRepository $carRepository,DriverRepository $driverRepository ): Response
    {
        $allCar = $carRepository->findAll();
        $allDriver = $driverRepository->findAll();

        return $this->render('home/index.html.twig', [
            'allCar' => $allCar,
            'allDriver' => $allDriver
        ]);
    }


        // TODO : route show : doit afficher le détails d'un film
    /**
     * affichage des détails d'un film
     *
     * @Route("/driver/{id}",name="app_home_show", requirements={"id"="\d+"})
     * @return Response
     */
    public function show(
        $id,
    
        CarRepository $carRepository,
        DriverRepository $driverRepository
        ): Response
    {
        // TODO : aller chercher le bon conducteur dans le BDD : DriverRepository->find()
        $driver = $driverRepository->find($id);
               

        // TODO : si le conducteur n'existe pas je doit renvoyer une 404
        // ! sinon cela va me faire une erreur coté twig
        if ($driver === null){
            // renvoyer une 404
            // on lance un exception 404 (notFound)
            // symfony va l'attraper et changer la réponse en réponse 404
            throw $this->createNotFoundException("le conducteur n'existe pas");
        }

        return $this->render("home/show.html.twig", 
        [
            "driverForView" => $driver
        ]);
    }

}
