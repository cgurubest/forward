<?php

namespace Cgurubest\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Cgurubest\BlogBundle\Form\EnquiryType;
use Cgurubest\BlogBundle\Entity\Enquiry;


use Cgurubest\BlogBundle\Entity\Post;
use Cgurubest\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('CgurubestBlogBundle::index.html.twig');
    }


    public function aboutAction()
    {
        return $this->render('CgurubestBlogBundle::about.html.twig');
    }


    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $type = new EnquiryType();

        //$form = $this->createForm($type, $enquiry);



//        $form = $this->createFormBuilder($enquiry)
//            ->add('name', 'text')
//            ->add('subject', 'text')
//            ->add('body', 'textarea')
//            ->add('email', 'email')
//            //->add('save', 'submit', array('label' => 'Create Task'))
//            ->getForm();

        $form = $this->createForm($type, $enquiry);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('cgurubest_blog_contact'));
            }
        }

        return $this->render('CgurubestBlogBundle::contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function addPostAction(Request $request){

        $form = $this->createForm(new PostType(), new Post());

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $post = new Post();
                $post->setTitle("title");
                $post->setBody("body");
                $post->setCreateAt(new \DateTime());
                $post->setUpdateAt(new \DateTime());
                $post->setIsActive(true);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($post);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('cgurubest_blog_post'));
            }
        }


        return $this->render('CgurubestBlogBundle::post.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
