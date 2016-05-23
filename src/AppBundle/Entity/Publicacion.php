<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Publicacion
 *
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", inversedBy="publicacion", cascade={"persist"})
     */

    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="votosPositivos", type="integer")
     */

    private $votosPositivos;

    /**
     * @var int
     *
     * @ORM\Column(name="votosNegativos", type="integer")
     */
    private $votosNegativos;



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
     * Set foto
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Publicacion
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->foto = $image;

        return $this;
    }

    /**
     * Get foto
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
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
        $this->votosPositivos = 0;
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
        $this->votosNegativos = 0;
    }


    
}
