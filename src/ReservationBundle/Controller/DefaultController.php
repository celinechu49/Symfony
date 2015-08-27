<?php

namespace ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ReservationBundle\Entity\Salle;
use ReservationBundle\Entity\Reservation;

class DefaultController extends Controller
{
    /**
     * @Route("/Home", name="reservationbundle_index")
     * @Template()
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$salle = new Salle();
    	$salle -> setNom('Salle 1');
    	
    	$salle2 = new Salle();
    	$salle2 -> setNom('Salle 2');
    	
    	$resa = new Reservation();
    	$resa -> setNom('Reservation 1');
    	
    	$resa2 = new Reservation();
    	$resa2 -> setNom('Réservation 2');
    	
    	$resa -> setSalle($salle);
    	
    	$resa2-> setSalle($salle2);
    	
    	/*$em->persist($salle);
    	$em->persist($resa);
    	$em->persist($salle2);
    	$em->persist($resa2);
    	
    	$em->flush();
    	*/
        return array('ma_salle' => $salle,
        'ma_resa' => $resa,
        'ma_resa2' => $resa2);
       
    }
    
    /**
    *
    * @Route("/salles", name="reservationbundle_salle")
    * @Template()
    */
    
    public function sallesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$repoSalles=$em->getRepository('ReservationBundle:Salle');
    	
    	$salles = $repoSalles->findAll();
    	
    	
    	return array(
    	'mes_salles'=> $salles );
    }
    
        /**
    *
    * @Route("/reservations", name="reservationbundle_reservation")
    * @Template()
    */
    
    public function reservationsAction()
    { 
    	$em = $this->getDoctrine()->getManager();
    	$repoResas=$em->getRepository('ReservationBundle:Reservation');
    	
    	$resas = $repoResas->findAll();
    	
    	
    	return array(
    	'mes_resas'=> $resas );
    	
    }
    
}
