<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ReservationBundle\Entity\ImageRepository")
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;




    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;
    
    public function upload()
	{ 
	//dump($this->file);
    // la propriété « file » peut être vide si le champ n'est pas requis
    if (null === $this->file) {
        return;
    }

    // utilisez le nom de fichier original ici mais
    // vous devriez « l'assainir » pour au moins éviter
    // quelconques problèmes de sécurité

    // la méthode « move » prend comme arguments le répertoire cible et
    // le nom de fichier cible où le fichier doit être déplacé
    $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
	//dump($this->getUploadRootDir());

    // définit la propriété « path » comme étant le nom de fichier où vous
    // avez stocké le fichier
    $this->path = $this->file->getClientOriginalName();
    
   // dump($this->path);

    // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
    $this->file = null;
	}

    public function getAbsolutePath()
    {
        return null === $this->path ? 
        null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? 
        null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents 
        // uploadés doivent être sauvegardés
        return __DIR__.'/../../../web'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de 
        //problème lorsqu'on affiche
        // le document/image dans la vue.
        return '/uploads/IMG';
    }
   


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
