<?php


namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @author Damian Wróblewski
 */
abstract class AbstractController extends Controller
{
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }

    /**
     * @return array
     */
    protected function getReferrer()
    {
        $request = $this->getRequest();
        $referrer = $request->headers->get('referer');


        $referrer = substr($referrer, strpos($referrer, '/') + 2); // remove http://


        // check domain
        $expectedDomain = $this->get('router')->getContext()->getHost();

        if ($pos = strpos($referrer, '/')) {
            $domain = substr($referrer, 0, $pos);
        } else {
            $domain = $referrer;
        }
        if ($domain != $expectedDomain) {
            return null;
        }
        $referrer = substr($referrer, strlen($domain));


        return $referrer;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return parent::getUser();
    }
}
