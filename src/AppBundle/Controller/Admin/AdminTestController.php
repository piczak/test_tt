<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\AbstractController;

class AdminTestController extends AbstractController
{
    public function indexAction()
    {
        return $this->render(':Admin:admin_test.html.twig');
    }
}
