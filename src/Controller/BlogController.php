<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Blog;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/create", name="create_blog")
     */
    public function create()
    {
        return $this->render('blog/create_blog.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/blog/create/process", name="process_create_blog")
     */
    public function processCreateBlog(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $created_blog = new Blog();
        date_default_timezone_set('Asia/Singapore');

        $created_blog->setCreationDate(new \DateTime());
        $created_blog->setModificationDate(new \DateTime());
        $created_blog->setFeaturedPhoto($request->request->get('blogFeaturedPhoto'));
        $created_blog->setFeaturedContent($request->request->get('blogFeaturedContent'));
        $created_blog->setTitle($request->request->get('blogTitle'));
        $created_blog->setContent($request->request->get('blogContent'));
        $created_blog->setAuthor($this->getUser());

        $em->persist($created_blog);
        $em->flush();
        return $this->render('home/index.html.twig', [
            'success' => 'Successfully created a new blog post!',
        ]);
    }


}
