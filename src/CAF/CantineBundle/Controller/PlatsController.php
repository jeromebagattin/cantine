<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\Plats;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PlatsController extends Controller
{
    public function addAction($type, $libelle, $porc, Request $request) {

        // Création de l'entité
        $plat = new Plats();
        $plat->setType($type);
        $plat->setLibelle($libelle);
        $plat->setPorc($porc);
       
        $em = $this->getDoctrine()->getManager();
        $em->persist($plat);
        $em->flush();

        // Reste de la méthode qu'on avait déjà écrit
//        if ($request->isMethod('POST')) {
//            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
//            return $this->redirect($this->generateUrl('caf_cantine_view', array('id' => $advert->getId())));
//        }

        return $this->render('CAFCantineBundle:Plats:add.html.twig', array (
            'type'      => $type,
            'libelle'   => $libelle,
            'porc'      => $porc
        ));
    }

    public function editAction($id, Request $request)
    {
        $content = $this->renderView('CAFCantineBundle:Plats:edit.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
    
    public function deleteAction($id, Request $request)
    {
        $content = $this->renderView('CAFCantineBundle:Plats:delete.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
    
    public function viewAction($id, Request $request)
    {
        $content = $this->renderView('CAFCantineBundle:Plats:view.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
}
