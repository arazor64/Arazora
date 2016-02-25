<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Blog;

/**
 * Blog controller.
 */
class BlogController extends Controller
{
	/**
	 *  @Route("/{id}", name="BlogBundle_blog_show", requirements={"id" = "\d+"})
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BlogBundle\Entity\Blog\Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }


        $comments = $em->getRepository('BlogBundle\Entity\Blog\Comment')
        ->getCommentsForBlog($blog->getId());
        
        return $this->render('BlogBundle:Blog:show.html.twig', array(
        		'blog'      => $blog,
        		'comments'  => $comments
        ));
        
    }
}