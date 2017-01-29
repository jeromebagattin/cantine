<?php

namespace CAF\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CAFTestBundle:Default:index.html.twig');
    }
}
