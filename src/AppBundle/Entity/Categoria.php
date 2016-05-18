<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
{

    const PAGINATION_ITEMS = 5;

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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Publicacion", mappedBy="categorias")
     */

    private $publicaciones;

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



    public function __construct()
    {
        $this->publicaciones = new ArrayCollection();
        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Categoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Añadir publicaciones
     * @param \AppBundle\Entity\Publicacion $publicacion
     * @return Categoria
     */

    public function añadirPublicacion(\AppBundle\Entity\Publicacion $publicacion)
    {
        $this->publicaciones[] = $publicacion;

        return $this;
    }

    /**
     * Borrar publicacion
     * @param \AppBundle\Entity\Publicacion $publicacion
     */

    public function borrarPublicacion(\AppBundle\Entity\Publicacion $publicacion)
    {
        $this->publicaciones->removeElement($publicacion);
    }

    /**
     * Get publicaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getPublicaciones()
    {
        return $this->publicaciones;
    }

    public function __toString()
    {
        return $this->nombre;
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
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    
    
}
