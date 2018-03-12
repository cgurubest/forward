<?php

namespace Cgurubest\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CgurubestBlogBundle:Default:index.html.twig', array('name' => $name));
    }

    public function index2Action()
    {
        return $this->render('CgurubestBlogBundle:Default:index2.html.twig');
    }
}
