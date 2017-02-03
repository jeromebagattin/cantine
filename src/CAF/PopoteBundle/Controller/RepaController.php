<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\Repa;
use CAF\PopoteBundle\Form\RepaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RepaController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $repas = $em->getRepository('CAFPopoteBundle:Repa')->findAll();

        if (null === $repas) {
            throw new NotFoundHttpException("Pas de Repa.");
        }

        $content = $this->get('templating')->render('CAFPopoteBundle:Repa:index.html.twig', array(
            'repas' => $repas
        ));
        return new Response($content);
    }
    
    public function viewAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repa = $em->getRepository('CAFPopoteBundle:Menu')->myfindId($id);
        
        if (null === $repa) {
            throw new NotFoundHttpException("Le repa d'id " . $id . " n'existe pas.");
        }

        $content = $this->get('templating')->render('CAFPopoteBundle:Repa:view.html.twig', array(
            'repa' => $repa,
        ));
        return new Response($content);
        
    }

    public function addAction($idMenu, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('CAFPopoteBundle:Menu')->find($idMenu);
        
        $repa = new Repa($menu);
       
        $form = $this->createForm(new RepaType(), $repa);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($repa);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Repa bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_repa_index', array('id' => $repa->getId())));
        }

        return $this->render('CAFPopoteBundle:Repa:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $repa = $em->getRepository('CAFPopoteBundle:Repa')->find($id);

        if (null === $repa) {
            throw new NotFoundHttpException("Le repa d'id " . $id . " n'existe pas.");
        }
        
        $form = $this->createForm(new RepaType(), $repa);

        foreach($repa->getMp() as $mp)
        {
            $repa->removeMp($mp);
            $em->remove($mp);
        }
        $em->persist($repa);
        
        if ($form->handleRequest($request)->isValid()) 
        {
            $em->persist($repa);
            $em->flush();
            return $this->redirect($this->generateUrl('popote_repa_index'));
        }
        
         return $this->render('CAFPopoteBundle:Repa:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id'   => $repa->getId()
        ));
    }
    
    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repa = $em->getRepository('CAFPopoteBundle:Repa')->find($id);

        if (null === $repa) {
            throw new NotFoundHttpException("Le repa d'id " . $id . " n'existe pas.");
        }
        
        
        foreach($repa->getMp() as $mp)
        {
            $repa->removeMp($mp);
            $em->remove($mp);
        }
        
        $em->persist($repa);
        $em->remove($repa);
        $em->flush();
        return $this->redirect($this->generateUrl('popote_repa_index'));
    }
}
