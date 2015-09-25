<?php

namespace mainBundle\Api;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class mySaint
{
	private $url;
	private $key;
	private $format;
	
	private $container;
	
	public function __construct(Container $container)
	
	{
		$this->container = $container;
		$this->url = $this->container->getParameter('fete_du_jour_url');
		$this->key = $this->container->getParameter('fete_du_jour_key');
		$this->format = $this->container->getParameter('fete_du_jour_format');			
	}
	
	public function getSaintOfTheDay()
	{
		//construction de l'url
		$url = $this->url.$this->key.$this->format;
		//dump($url);
		
		// instanciation et execution d'une requete CURL
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$json_response = curl_exec($curl);
		curl_close($curl);
		dump($json_response);
		
		//décodage de la reponse json -> tableau PHP
		$response = json_decode($json_response, true);
		dump($response);
		
		return $response['name'];
		
	}
 
 }