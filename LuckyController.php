<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/home", name="Home")
     *
     * 
     */
    public function number(): Response
    {
        $title = "Team DR";
        $number = random_int(0, 100);
        $menu = ['Home','Blog','Contact','Register'];


        $contents =  $this->renderView('lucky/home.html.twig', [
            'number' => $number,
            'title' => $title,
            'menu' => $menu,
        ]);
        return new Response($contents);
    }
    /**
     * @Route("lucky/contact",name="Contact",methods={"GET"})
     */
    public function contact()
    {
        $phone = "123-456-789";
        $email = "contact@teamdr.com";
        $title = "Contact Us";
        $menu = ['Home','Blog','Contact','Register'];

        $contact = $this->renderView('lucky/contact.html.twig', [
            'phone' => $phone,
            'email' => $email,
            'title' => $title,
            'menu' => $menu,
        ]);
        return new Response($contact);

    }
}

