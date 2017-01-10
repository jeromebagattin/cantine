<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\Plats;
use CAF\CantineBundle\Form\PlatsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlatsController extends Controller
{
    public function addAction(Request $request) {
        $plat = new Plats();
  
        $form = $this->createForm(new PlatsType(), $plat);

         if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Plat bien enregistrée.');
            return $this->redirect($this->generateUrl('caf_plats_view', array('id' => $plat->getId())));
        }

        return $this->render('CAFCantineBundle:Plats:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    
    public function ajoutAction($type, $libelle, $porc, Request $request) {

        // Création de l'entité
        $plat = new Plats();
        $plat->setLibelle($libelle);
        $plat->setPorc($porc);
       
        
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:TypePlat')
        ;
        $typePlat = $repository->find($type);
        if (null === $typePlat) {
            throw new NotFoundHttpException("Le type de plat d'id " . $type . " n'existe pas.");
        }
        
        $plat->setTypePlat($typePlat);
                
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
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:Plats')
        ;
        $plat = $repository->find($id);
        if (null === $plat) {
            throw new NotFoundHttpException("Le plat d'id " . $id . " n'existe pas.");
        }

        $content = $this->renderView('CAFCantineBundle:Plats:view.html.twig', array (
             'plat' => $plat
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
}
