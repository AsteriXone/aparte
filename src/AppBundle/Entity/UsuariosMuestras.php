<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosMuestras
 *
 * @ORM\Table(name="usuarios_muestras")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuariosMuestrasRepository")
 */
class UsuariosMuestras
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="usuario_id", type="integer")
     */
    private $usuarioId;

    /**
     * @var int
     *
     * @ORM\Column(name="muestra_id", type="integer")
     */
    private $muestraId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usuarios_muestras")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Muestra", inversedBy="usuarios_muestras")
     */
    private $muestra;

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getUsuario()." - ".$this->getMuestra();
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
     * Set usuarioId
     *
     * @param integer $usuarioId
     *
     * @return UsuariosMuestras
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return int
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set muestraId
     *
     * @param integer $muestraId
     *
     * @return UsuariosMuestras
     */
    public function setMuestraId($muestraId)
    {
        $this->muestraId = $muestraId;

        return $this;
    }

    /**
     * Get muestraId
     *
     * @return int
     */
    public function getMuestraId()
    {
        return $this->muestraId;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return UsuariosMuestras
     */
    public function setUsuario(\AppBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set muestra
     *
     * @param \AppBundle\Entity\Muestra $muestra
     *
     * @return UsuariosMuestras
     */
    public function setMuestra(\AppBundle\Entity\Muestra $muestra = null)
    {
        $this->muestra = $muestra;

        return $this;
    }

    /**
     * Get muestra
     *
     * @return \AppBundle\Entity\Muestra
     */
    public function getMuestra()
    {
        return $this->muestra;
    }
}
