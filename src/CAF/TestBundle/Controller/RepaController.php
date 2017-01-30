<?php

namespace CAF\TestBundle\Controller;


class RepaController extends MenuController {

    public function addRepaAction() {
        $repa = new Repa();
        $form = $this->createForm(new RepaType(), $repa);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($repa);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Repa bien enregistrée.');
            return $this->redirect($this->generateUrl('test_repa_index', array('id' => $repa->getId())));
        }

        return $this->render('CAFTestBundle:Repa:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
