<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $blog_repository = $this->getDoctrine()->getRepository(Blog::class);
        $blogs = $blog_repository->findBy([], ['modificationDate' => 'DESC']);

        return $this->render('home/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }


}
