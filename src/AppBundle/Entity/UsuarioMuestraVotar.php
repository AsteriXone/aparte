<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioMuestraVotar
 *
 * @ORM\Table(name="usuario_muestra_votar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioMuestraVotarRepository")
 */
class UsuarioMuestraVotar
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
     * @ORM\Column(name="muestra_votar_id", type="integer")
     */
    private $muestraVotarId;

    /**
     * @var int
     *
     * @ORM\Column(name="grupo_id", type="integer")
     */
    private $grupoPerteneciente;



    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usuarios_muestras_votar")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="MuestraVotar", inversedBy="usuarios_muestras_votar")
     */
    private $muestraVotar;


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
     * @return UsuarioMuestraVotar
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * Set muestraVotarId
     *
     * @param integer $muestraVotarId
     *
     * @return UsuarioMuestraVotar
     */
    public function setMuestraVotarId($muestraVotarId)
    {
        $this->muestraVotarId = $muestraVotarId;

        return $this;
    }

    /**
     * Get muestraVotarId
     *
     * @return integer
     */
    public function getMuestraVotarId()
    {
        return $this->muestraVotarId;
    }

    /**
     * Set grupoPerteneciente
     *
     * @param integer $grupoPerteneciente
     *
     * @return UsuarioMuestraVotar
     */
    public function setGrupoPerteneciente($grupoPerteneciente)
    {
        $this->grupoPerteneciente = $grupoPerteneciente;

        return $this;
    }

    /**
     * Get grupoPerteneciente
     *
     * @return integer
     */
    public function getGrupoPerteneciente()
    {
        return $this->grupoPerteneciente;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return UsuarioMuestraVotar
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
     * Set muestraVotar
     *
     * @param \AppBundle\Entity\MuestraVotar $muestraVotar
     *
     * @return UsuarioMuestraVotar
     */
    public function setMuestraVotar(\AppBundle\Entity\MuestraVotar $muestraVotar = null)
    {
        $this->muestraVotar = $muestraVotar;

        return $this;
    }

    /**
     * Get muestraVotar
     *
     * @return \AppBundle\Entity\MuestraVotar
     */
    public function getMuestraVotar()
    {
        return $this->muestraVotar;
    }
}
