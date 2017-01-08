<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\TypePlat;
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
    
    public function addAction($libelle) {

        // Création de l'entité
        $typeplat = new TypePlat();
        $typeplat->setLibelle($libelle);
                
        $em = $this->getDoctrine()->getManager();
        $em->persist($typeplat);
        $em->flush();

        // Reste de la méthode qu'on avait déjà écrit
//        if ($request->isMethod('POST')) {
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//            return $this->redirect($this->generateUrl('caf_cantine_view', array('id' => $advert->getId())));
//        }

        return $this->render('CAFCantineBundle:TypePlats:add.html.twig', array (
            'libelle'   => $libelle
        ));
    }
}
