<?php

namespace CAF\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlatController extends Controller
{
    public function indexAction()
    {
        return $this->render('CAFTestBundle:Plat:index.html.twig', array(
            // ...
        ));
    }

}
