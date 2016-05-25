<?php
/**
 * (c) Ismael Trascastro <i.trascastro@gmail.com>
 *
 * @link        http://www.ismaeltrascastro.com
 * @copyright   Copyright (c) Ismael Trascastro. (http://www.ismaeltrascastro.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Edgar\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="Edgar\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="upated_at", type="datetime")
     */

    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Publicacion", mappedBy="autor", cascade={"remove"})
     */

    private $publicaciones;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comentario", mappedBy="autor", cascade={"remove"})
     */
    private $comentarios;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Logro", mappedBy="usuario", cascade={"remove"})
     */

    private $logros;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Publicacion", mappedBy="owner")
     */
    private $publis;

    /**
     * User constructor.
     */

    public function __construct()
    {
        parent::__construct();

        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;
        $this->publicaciones     = new ArrayCollection();
        $this->comentarios    = new ArrayCollection();
        $this->logros    = new ArrayCollection();
        $this->publis = new ArrayCollection();
    }

    public function setCreatedAt()
    {
        // never used
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
     * @ORM\PreUpdate()
     *
     * @return User
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

    public function __toString()
    {
        return $this->username;
    }


    /**
     * @return mixed
     */
    public function getPublicaciones()
    {
        return $this->publicaciones;
    }

    /**
     * @param mixed $publicaciones
     * @return $this
     */
    public function setPublicaciones($publicaciones)
    {
        $this->publicaciones = $publicaciones;
        return $this;
    }
    
    
}