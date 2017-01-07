<?php

namespace CAF\CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TypePlatsController extends Controller
{
    public function viewAction($id, Request $request)
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:TypePlat')
        ;
        $typeplat = $repository->find($id);
        if (null === $typeplat) {
            throw new NotFoundHttpException("Le typeplat d'id " . $id . " n'existe pas.");
        }

        $content = $this->renderView('CAFCantineBundle:TypePlats:view.html.twig', array (
             'typeplat' => $typeplat
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
}
