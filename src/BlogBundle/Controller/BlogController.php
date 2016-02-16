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
	 *  @Route("/{id}", requirements={"id" = "\d+"}, defaults={"id" = 1})
	 */
	public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BlogBundle\Entity\Blog\Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BlogBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
        ));
    }
}