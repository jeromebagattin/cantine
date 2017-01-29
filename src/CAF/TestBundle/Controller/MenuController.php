<?php

namespace CAF\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        return $this->render('CAFTestBundle:Menu:index.html.twig', array(
            // ...
        ));
    }

}
