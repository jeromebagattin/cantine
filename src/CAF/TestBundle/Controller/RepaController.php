<?php

namespace CAF\TestBundle\Controller;
use Symfony\Component\HttpFoundation\Request;

class RepaController extends MenuController {

    public function addRepaAction(Request $request) {
//        $repa = new Repa();
//        $form = $this->createForm(new RepaType(), $repa);
//
//        if ($form->handleRequest($request)->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($repa);
//
//            $em->flush();
//
//            $request->getSession()->getFlashBag()->add('notice', 'Repa bien enregistrée.');
//            return $this->redirect($this->generateUrl('test_repa_index', array('id' => $repa->getId())));
//        }

//        //        return $this->render('CAFTestBundle:Repa:add.html.twig', array(
//                    'form' => $form->createView(),
//        ));
        
         $response = parent::addAction($request);
        return($response);
        
    }

}
