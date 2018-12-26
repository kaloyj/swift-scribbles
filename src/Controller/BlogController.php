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

    /**
     * @Route("/blog/{blog_id}/update", name="update_blog")
     */
    public function update($blog_id)
    {
        $blog_repository = $this->getDoctrine()->getRepository(Blog::class);
        $toUpdate_blog = $blog_repository->find($blog_id);
        return $this->render('blog/update_blog.html.twig', [
            'blog' => $toUpdate_blog,
        ]);
    }

    /**
     * @Route("/blog/{blog_id}/update/process", name="process_update_blog")
     */
    public function processUpdateBlog(Request $request, $blog_id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog_repository = $this->getDoctrine()->getRepository(Blog::class);
        $toUpdate_blog = $blog_repository->find($blog_id);
        date_default_timezone_set('Asia/Singapore');

        $toUpdate_blog->setCreationDate(new \DateTime());
        $toUpdate_blog->setModificationDate(new \DateTime());
        $toUpdate_blog->setFeaturedPhoto($request->request->get('blogFeaturedPhoto'));
        $toUpdate_blog->setFeaturedContent($request->request->get('blogFeaturedContent'));
        $toUpdate_blog->setTitle($request->request->get('blogTitle'));
        $toUpdate_blog->setContent($request->request->get('blogContent'));
        $toUpdate_blog->setAuthor($this->getUser());

        $em->persist($toUpdate_blog);
        $em->flush();

        $blogs = $blog_repository->findBy([], ['modificationDate' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'success' => 'Successfully updated blog: '.$toUpdate_blog->getTitle(),
            'blogs' => $blogs,
        ]);
    }


}
