<?php
//src/Controller/UserController.php
namespace App\Controller;

use App\Form\Type\UserType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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

    public function new(Request $request): Response
    {
        //set up new $user object
        $user = new User();

        $form = $this->createForm(UserType::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            var_dump($user);

            // create connection to DB and save submitted data in DB Table User
            $entityManager = $this->getDoctrine()->getManager();
            //tell doctrine that you may want to save User in DB Table
            $entityManager->persist($user);
            //execute query and save (INSERT INTO)
            $entityManager->flush();
            // display flash message with confirmation and redirect
            $this->addFlash(
                'notice',
                'You have been registered'
            );
            //redirect after submitting a form and pass $user as parameter to display info 
            return $this->redirectToRoute('registered');
        }

        return $this->render('lucky/register.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("lucky/registered",name="registered")
     */
    public function registered_confirmation()
    {
        $menu = ['Home','Blog','Contact'];
        $title = 'Registration Confirmation Page';
        // $reg_user = $this->get($username); 

        $confirmation = $this->renderView('lucky/registered.html.twig', [
           
            'menu' => $menu,
            'title' => $title,
        ]);
        return new Response($confirmation);
    }
} 
