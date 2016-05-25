<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;



/**
 * Publicacion
 *
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="publicacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Publicacion
{


    const PAGINATION_ITEMS = 4;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255)
     */
    private $contenido;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Categoria", cascade={"persist"}, inversedBy="publicaciones")
     */
    private $categorias;

    /**
     * @var string
     */
    private $nuevasCategorias;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="Edgar\UserBundle\Entity\User", inversedBy="publicaciones")
     */

    private $autor;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comentario", mappedBy="publicacion", cascade={"remove"})
     */
    private $comentarios;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="image_upload", fileNameProperty="imageName")
     *
     * @var File
     */
    private $publiFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     *
     */
    private $imageName;


    /**
     * @ORM\ManyToOne(targetEntity="Edgar\UserBundle\Entity\User", cascade={"persist"}, inversedBy="publis")
     */
    private $owner;


    /**
     * @var int
     *
     * @ORM\Column(name="votosPositivos", type="integer")
     */
    private $votosPositivos = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="votosNegativos", type="integer")
     */
    private $votosNegativos = 0;



    public function __construct()
    {
        $this->categorias   = new ArrayCollection();
        $this->comentarios  = new ArrayCollection();
        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;
        $this->votosPositivos = new ArrayCollection();
        $this->votosNegativos = new ArrayCollection();
    }



    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Publicacion
     */
    public function setpubliFile(File $image = null)
    {
        $this->publiFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }
    /**
     * @return File
     */
    public function getPubliFile()
    {
        return $this->publiFile;
    }

    /**
     * @param string $imageName
     *
     * @return Publicacion
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }
    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Publicacion
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Publicacion
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Publicacion
     */
    public function setCreatedAt(/*$createdAt*/)
    {
        /*$this->createdAt = $createdAt;

        return $this;*/
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Publicacion
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Añadir categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     * @return Publicacion
     */

    public function añadirCategoria(\AppBundle\Entity\Categoria $categoria)
    {
        $this->categorias[] = $categoria;

        return $this;
    }

    /**
     * Borrar Categoria
     *
     * @param \AppBundle\Entity\categoria $categoria
     */

    public function borrarcategoria(\AppBundle\Entity\Categoria $categoria)
    {
        $this->categorias->removeElement($categoria);
    }

    /**
     * Get categorias
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getCategorias()
    {
        return $this->categorias;
    }


    public function __toString()
    {
        return $this->contenido;
    }

    /**
     * @return string
     */

    public function getNuevasCategorias()
    {
        return $this->nuevasCategorias;
    }

    /**
     * @param $nuevasCategorias
     * @return $this
     */
    public function setNuevasCategorias($nuevasCategorias)
    {
        $this->nuevasCategorias = $nuevasCategorias;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     * @return $this
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Añadir comentario
     *
     * @param \AppBundle\Entity\Comentario $comentario
     * @return Publicacion
     */

    public function añadirComentario(\AppBundle\Entity\Comentario $comentario)
    {
        $this->comentarios[] = $comentario;

        return $this;

    }

    /**
     * Borrar comentario
     *
     * @param \AppBundle\Entity\Comentario $comentario
     */

    public function borrarComentario(\AppBundle\Entity\Comentario $comentario)
    {
        $this->comentarios->removeElement($comentario);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getComentarios()
    {
        return $this->comentarios;
    }


   

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }



    


    /**
     * @return int
     */
    public function getVotosPositivos()
    {
        return $this->votosPositivos;
    }

    /**
     * @param int $votosPositivos
     */
    public function setVotosPositivos()
    {
        $this->votosPositivos = $this->votosPositivos + 1;
    }

    /**
     * @return int
     */
    public function getVotosNegativos()
    {
        return $this->votosNegativos;
    }

    /**
     * @param int $votosNegativos
     */
    public function setVotosNegativos()
    {
        $this->votosNegativos = $this->votosNegativos + 1;
    }


    
}
