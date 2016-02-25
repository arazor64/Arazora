<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Blog\Comment;
use BlogBundle\Form\Blog\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Comment controller.
 */
class CommentController extends Controller
{
	/**
	 *  @Route("/comment/{blog_id}", name="BlogBundle_comment_create", requirements={"id" = "\d+"})
	 */
	public function newAction($blog_id)
	{
		$blog = $this->getBlog($blog_id);

		$comment = new Comment();
		$comment->setBlog($blog);
		$form   = $this->createForm(new CommentType(), $comment);

		return $this->render('BlogBundle:Comment:form.html.twig', array(
				'comment' => $comment,
				'form'   => $form->createView()
		));
	}

	/**
	 *  @Route("/comment/create/{blog_id}", name="BlogBundle_comment_create", requirements={"id" = "\d+"})
	 */
	public function createAction($blog_id)
	{
		$blog = $this->getBlog($blog_id);

		$comment  = new Comment();
		$comment->setBlog($blog);
		$request = $this->getRequest();
		$form    = $this->createForm(new CommentType(), $comment);
		$form->bindRequest($request);

	      if ($form->isValid()) {
            $em = $this->getDoctrine()
                       ->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('BlogBundle_blog_show', array(
                'id' => $comment->getBlog()->getId())) .
                '#comment-' . $comment->getId()
            );
        }

		return $this->render('BlogBundle:Comment:create.html.twig', array(
				'comment' => $comment,
				'form'    => $form->createView()
		));
	}

	protected function getBlog($blog_id)
	{
		$em = $this->getDoctrine()
		->getEntityManager();

		$blog = $em->getRepository('BlogBundle:Blog')->find($blog_id);

		if (!$blog) {
			throw $this->createNotFoundException('Unable to find Blog post.');
		}

		return $blog;
	}

}