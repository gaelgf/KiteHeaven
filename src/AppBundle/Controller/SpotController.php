<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Notice;
use AppBundle\Repository\NoticeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Spot;
use AppBundle\Form\SpotType;

/**
 * Spot controller.
 *
 * @Route("/spot")
 */
class SpotController extends Controller
{
    /**
     * Lists all Spot entities.
     *
     * @Route("/", name="spot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $spots = $em->getRepository('AppBundle:Spot')->findAll();

        return $this->render('spot/index.html.twig', array(
            'spots' => $spots,
        ));
    }

    /**
     * Creates a new Spot entity.
     *
     * @Route("/new", name="spot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $spot = new Spot();
        $spot->setUser($this->get('security.token_storage')->getToken()->getUser());
        $form = $this->createForm('AppBundle\Form\SpotType', $spot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file= $spot->getImageTitle();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('file_upload_directory'),
                $fileName
            );
            $spot->setImageTitle($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($spot);
            $em->flush();

            return $this->redirectToRoute('spot_show', array('id' => $spot->getId()));
        }

        return $this->render('spot/new.html.twig', array(
            'spot' => $spot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Spot entity.
     *
     * @Route("/{id}", name="spot_show")
     * @Method({"GET", "POST"})
     * @param Spot $spot
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Spot $spot, Request $request)
    {
        $deleteForm = $this->createDeleteForm($spot);

        $notice = new Notice();
        $noticeForm = $this->createForm('AppBundle\Form\NoticeType', $notice);
        $noticeForm->handleRequest($request);

        $comment = new Comment();
        $commentForm = $this->createForm('AppBundle\Form\CommentType', $comment);
        $commentForm->handleRequest($request);

        if ($noticeForm->isSubmitted() && $noticeForm->isValid()) {
            $notice->setUser($this->get('security.token_storage')->getToken()->getUser());
            $notice->setSpot($spot);
            $em = $this->getDoctrine()->getManager();
            $em->persist($notice);
            $em->flush();

            return $this->redirectToRoute('spot_show', array('id' => $spot->getId()));
        }


        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setUser($this->get('security.token_storage')->getToken()->getUser());
            $comment->setSpot($spot);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('spot_show', array('id' => $spot->getId()));
        }

        $em = $this->getDoctrine()->getManager();
        /**
         * @var NoticeRepository $noticeRepository
         */
        $noticeRepository = $em->getRepository('AppBundle:Notice');
        $averageNote = $noticeRepository->getAverageNotes($spot->getId());
        $items = $spot->getItems();
        return $this->render('spot/show.html.twig', array(
            'spot' => $spot,
            'delete_form' => $deleteForm->createView(),
            'comment_form' => $commentForm->createView(),
            'notice_form' => $noticeForm->createView(),
            'notices' => $spot->getNotices(),
            'comments' => $spot->getComments(),
            'averageNote' => number_format($averageNote, 2, ',', ' '),
            'items' => $items
        ));
    }

    /**
     * Displays a form to edit an existing Spot entity.
     *
     * @Route("/{id}/edit", name="spot_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Spot $spot)
    {
        $deleteForm = $this->createDeleteForm($spot);
        $editForm = $this->createForm('AppBundle\Form\SpotType', $spot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spot);
            $em->flush();

            return $this->redirectToRoute('spot_edit', array('id' => $spot->getId()));
        }

        return $this->render(
            'spot/edit.html.twig',
            array(
                'spot' => $spot,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                )
        );

    }

    /**
     * Deletes a Spot entity.
     *
     * @Route("/{id}", name="spot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Spot $spot)
    {
        $form = $this->createDeleteForm($spot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($spot);
            $em->flush();
        }

        return $this->redirectToRoute('spot_index');
    }

    /**
     * Creates a form to delete a Spot entity.
     *
     * @param Spot $spot The Spot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Spot $spot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spot_delete', array('id' => $spot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
