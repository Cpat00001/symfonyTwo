<?php
//src/Controller/UserController.php
namespace App\Controller;

use App\Form\Type\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

     /**
     * @Route("/lucky/register", name="Register")
     *
     * 
     */

    public function new(): Response
    {
        //create a form for new User Registration
        $user = new User();

        $form = $this->createForm(UserType::class,$user);

        return $this->render('lucky/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }
} 
