<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\Plat;
use CAF\PopoteBundle\Form\PlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlatController extends Controller
{
    public function addAction(Request $request) {
        $plat = new Plat();
  
        $form = $this->createForm(new PlatType(), $plat);

         if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Plat bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_plat_index', array('id' => $plat->getId())));
        }

        return $this->render('CAFPopoteBundle:Plat:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    
    public function ajoutAction($type, $libelle, $porc) {

        // Création de l'entité
        $plat = new Plat();
        $plat->setLibelle($libelle);
        $plat->setPorc($porc);
       
        
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFPopoteBundle:TypePlat')
        ;
        $typePlat = $repository->find($type);
        if (null === $typePlat) {
            throw new NotFoundHttpException("Le type de plat d'id " . $type . " n'existe pas.");
        }
        
        $plat->setTypePlat($typePlat);
                
        $em = $this->getDoctrine()->getManager();
        $em->persist($plat);
        $em->flush();

        return $this->render('CAFPopoteBundle:Plat:add.html.twig', array (
            'type'      => $type,
            'libelle'   => $libelle,
            'porc'      => $porc
        ));
    }

    public function editAction(Plat $plat, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PlatType(), $plat);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($plat);
            $em->flush();

            return $this->redirect($this->generateUrl('popote_plat_index'));
        }

        return $this->render('CAFPopoteBundle:Plat:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $plat->getId()
        ));
    }
    
    public function deleteAction(Plat $plat)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($plat);
        $em->flush();

        return $this->redirect($this->generateUrl('popote_plat_index'));
    }
    
    public function viewAction(Plat $plat, Request $request)
    {
        $content = $this->renderView('CAFPopoteBundle:Plat:view.html.twig', array (
             'plat' => $plat
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
    
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFPopoteBundle:Plat')
        ;
        $plats = $repository->myFindAll();
        if (null === $plats) {
            throw new NotFoundHttpException("Pas de plat.");
        }

        $content = $this->renderView('CAFPopoteBundle:Plat:index.html.twig', array (
             'plats' => $plats
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }
}
