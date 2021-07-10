<?php

// src/Controller/BlogController
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("lucky/blog", name="Blog", methods={"GET"})
     */
    public function list(): Response
    {

        $title = "Team DR Blog";
        $menu = ['Home','Blog','Contact'];

        // show all BlogPosts
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
        
        // var_dump($blogs);
        $contents =  $this->renderView('lucky/blog.html.twig', [
            'title' => $title,
            'menu' => $menu,
            'blogs' => $blogs,
        ]);
        // if dont exists any BlogPosts show message
        if (!$blogs) {
            throw $this->createNotFoundException(
                'No BlogPosts found'
            );
        }
        return new Response($contents);
    }
    //show indyvidual BlogPost

    /**
     * @Route("lucky/details/{id}", name="show_unique_blogpost")
     */
    public function show_unique( int $id): Response
    {
        $blogpost = $this->getDoctrine()->getRepository(Blog::class)->find($id);

        $title = "Team DR BlogDetails";
        $menu = ['Home','Blog','Contact'];

        $contents = $this->renderView('lucky/details.html.twig',[
            'blogpost' => $blogpost,
            'title' => $title,
            'menu' => $menu,
        ]);

        if(!$blogpost){
            throw $this->createNotFoundException(
                'Sorry no BlogPost found with this id ' . $id
            );
        }
        // return new Response($contents);
        return new Response($contents);
    }
    /**
     * @Route("lucky/addNewBlogPost", name="create_blogpost")
     */
    public function createBlogPost():Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $blogpost = new Blog();
        $blogpost->setTitle("BlogPost Three");
        $blogpost->setDescription("short desciprtion for BlogPost Three");
        $blogpost->setCreated(new \DateTime());

        //tell doctrine you want to execute and save(eventually) Blog
        $entityManager->persist($blogpost);
        //acutally execute a query(INSERT INTO)
        $entityManager->flush();

        return new Response('Saved new BlogPost with id '. $blogpost->getId());
    }
}
