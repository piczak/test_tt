<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function indexAction()
    {
        return $this->render('Test/test.html.twig');
    }
}