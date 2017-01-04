<?php

namespace CAF\CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RepasController extends Controller
{
    public function indexAction($id, Request $request)
    {
        $content = $this->renderView('CAFCantineBundle:Repas:index.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
}
