<?php

namespace CAF\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RepaController extends MenuController
{
    public function addAction()
    {
        return $this->render('CAFTestBundle:Repa:add.html.twig', array(
            // ...
        ));
    }

}
