<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Item;
use AppBundle\Entity\Notice;
use AppBundle\Form\ItemType;
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
 * @Route("/item")
 */
class ItemController extends Controller
{
    /**
     * Lists all item entities.
     *
     * @Route("/item", name="item_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $spots = $em->getRepository('AppBundle:Item')->findAll();

        return $this->render('item/index.html.twig', array(
            'spots' => $spots,
        ));
    }

    /**
     * Lists video Item entities.
     *
     * @Route("/video", name="video_list")
     * @Method("GET")
     */
    public function videoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('AppBundle:Item')->findBy(array('type' => 'video'));

        return $this->render('item/video_list.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     * Lists video Item entities.
     *
     * @Route("/image", name="image_list")
     * @Method("GET")
     */
    public function imageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $items = $em->getRepository('AppBundle:Item')->findBy(array('type' => 'image'));

        return $this->render('item/image_list.html.twig', array(
            'items' => $items,
        ));
    }

    /**
     * Creates a new item image entity.
     *
     * @Route("/new_image", name="image_new")
     * @Method({"GET", "POST"})
     */
    public function newImageAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm('AppBundle\Form\ItemType',
            $item,
            array('item_type' => 'image', 'id_user' => $this->getUser()->getId())
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var array $files
             */
            $files = $item->getUrl();
            $spot = $item->getSpot();
            $categories = $item->getCategories();
            $em = $this->getDoctrine()->getManager();
            foreach ($files as $file) {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('file_upload_directory'),
                    $fileName
                );

                $item = new Item();
                $item->setType('image');
                $item->setSpot($spot);
                $item->setUrl($fileName);
                $em->persist($item);

                foreach($categories as $category) {
                    $category->getItems()->add($item);
                }
            }
            $em->flush();
            return $this->redirectToRoute('image_list');
        }

        return $this->render('item/new.html.twig', array(
            'item'       => $item,
            'form'       => $form->createView()
        ));
    }

    /**
     * Creates a new item video entity.
     *
     * @Route("/new_video", name="video_new")
     * @Method({"GET", "POST"})
     */
    public function newVideoAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm('AppBundle\Form\ItemType', $item, array(
            'item_type' => 'video', 'id_user' => $this->getUser()->getId()
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item->setType('video');
            $categories = $item->getCategories();
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            foreach($categories as $category) {
                $category->getItems()->add($item);
            }
            $em->flush();
            return $this->redirectToRoute('video_list');
        }

        return $this->render('item/new_video.html.twig', array(
            'item'       => $item,
            'form'       => $form->createView()
        ));
    }
    /**
     * Finds and displays a Spot entity.
     *
     * @Route("/{id}", name="item_show")
     * @Method({"GET", "POST"})
     * @param Item $item
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Item $item, Request $request)
    {
    }

    /**
     * Displays a form to edit an existing Spot entity.
     *
     * @Route("/{id}/edit", name="item_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Item $item
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Item $item)
    {
        $deleteForm = $this->createDeleteForm($item);
        $editForm = $this->createForm('AppBundle\Form\ItemType', $item, array(
            'item_type' => 'edit', 'id_user' => $this->getUser()->getId()
            )
        );
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('item_edit', array('id' => $item->getId()));
        }

        return $this->render(
            'item/edit.html.twig',
            array(
                'item' => $item,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );

    }

    /**
     * Deletes a Item entity.
     *
     * @Route("/{id}", name="item_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Item $item)
    {
        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('item_index');
    }

    /**
     * Creates a form to delete a Item entity.
     *
     * @param Item $item The Item entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Item $item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
