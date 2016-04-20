<?php

namespace AppBundle\Controller\User;

use AppBundle\Controller\AbstractController;

class UserTestController extends AbstractController
{
    public function indexAction()
    {
        return $this->render(':User:user_test.html.twig');
    }
}
