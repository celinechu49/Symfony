<?php

namespace mainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class mainController extends Controller
{
	/**
	*
	* @route("/", name="main_homepage")
	* @Template()
	* @Method ("GET")
	*/
    public function indexAction()
    { $name= "Celine";
    
    $serviceSaintDuJour = $this->get('main.getMySaint');
    $saint = $serviceSaintDuJour->getSaintOfTheDay();
    
      //  return $this->render('mainBundle:Main:index.html.twig');
        
       return array('nom' => $name, 'saint' => $saint);
    }
}
