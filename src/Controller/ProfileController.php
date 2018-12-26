<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog;
use App\Entity\User;

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

    /**
     * @Route("/profile/update", name="update_profile")
     */
    public function update()
    {
        $user_repository = $this->getDoctrine()->getRepository(User::class);
        $toUpdate_user = $user_repository->find($this->getUser()->getId());

        $blogs = $toUpdate_user->getBlogs();
        return $this->render('profile/update_profile.html.twig', [
            'user' => $toUpdate_user,
            'blogs' => $blogs,
        ]);
    }
}
