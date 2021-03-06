<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class AdminController extends EasyAdminController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction(Request $request)
    {
      if (!$this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
          throw $this->createAccessDeniedException();
      }

        return parent::indexAction($request);
    }

    public function createEditForm($entity, array $entityProperties)
    {
        $editForm = parent::createEditForm($entity, $entityProperties);

        if ($entity instanceof User) {
            // the trick is to remove the default field and then
            // add the customized field
            $editForm->remove('city');
            $editForm->add('city', 'choice', array('choices' => array(
                'London', 'New York', 'Paris', 'Tokyo'
            )));
        }

        return $editForm;
    }



}
