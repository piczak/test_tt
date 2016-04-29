<?php


namespace AppBundle\Controller;

/**
 * @author Damian Wróblewski
 */
class FrontController extends AbstractController
{
    public function indexAction()
    {
        
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('ROLE_ADMIN')) {
            return $this->redirect($this->generateUrl('admin_calculator_page'));
        } else if ($securityContext->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('user_test_page'));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}