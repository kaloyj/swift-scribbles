<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $blog_repository = $this->getDoctrine()->getRepository(Blog::class);
        $user = $this->getUser();
        $blogs = $blog_repository->findBy(['Author' => $user ], ['modificationDate' => 'DESC']);

        return $this->render('profile/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
}
