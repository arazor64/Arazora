<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BlogBundle\Entity\Blog\Enquiry;
use BlogBundle\Form\Blog\EnquiryType;
use BlogBundle\Entity\Blog\Blog;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class PageController extends Controller
{
	/**
	 * @Route("/", name="BlogBundle_homepage")
	 */
    public function indexAction()
    {
    	
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blogs = $em->getRepository('BlogBundle\Entity\Blog\Blog')
                    ->getLatestBlogs();

        return $this->render('BlogBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }	
    
	/**
	 * @Route("/about", name="BlogBundle_about")
	 */
	public function aboutAction() {
		return $this->render('BlogBundle:Page:about.html.twig');
	}
	
	/**
	 * @Route("/contact", name="BlogBundle_contact")
	 */
	public function contactAction(Request $request)
	{
		
	    $enquiry = new Enquiry();
	 	    
	    $form = $this->createFormBuilder($enquiry)
	    ->add('name', TextType::class)
	    ->add('email', EmailType::class)
		->add('subject', TextType::class)
		->add('body', TextType::class)
	    ->add('save', SubmitType::class, array('label' => 'Submit'))
	    ->getForm();
	    
	    $form->handleRequest($request);
	    
	    if ($form->isSubmitted() && $form->isValid()) {
	    	// ... perform some action, such as saving the task to the database
	    	$message = \Swift_Message::newInstance()
	    	->setSubject('Contact enquiry from Arazora')
	    	->setFrom('test@test.co.uk')
	    	->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
	    	->setBody($this->renderView('BlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
	    	$this->get('mailer')->send($message);
	    	
//	    	$this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
	    	
	        return $this->redirect($this->generateUrl('BlogBundle_contact'));
	    }
	    
	    return $this->render('BlogBundle:Page:contact.html.twig', array(
	        'form' => $form->createView()
	    ));
	}
}
