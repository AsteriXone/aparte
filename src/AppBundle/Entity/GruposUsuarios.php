<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GruposUsuarios
 *
 * @ORM\Table(name="grupos_usuarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GruposUsuariosRepository")
 */
class GruposUsuarios
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
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="grupos_usuarios")
      */
    private $grupo;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="grupos_usuarios")
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $usuarioId;

    /**
     * @var int
     *
     * @ORM\Column(name="grupo_id", type="integer", nullable=true)
     */
    private $grupoId;

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
     * @return GruposUsuarios
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
     * Set gruposUsuarios
     *
     * @param \AppBundle\Entity\Grupo $gruposUsuarios
     *
     * @return GruposUsuarios
     */
    public function setGruposUsuarios(\AppBundle\Entity\Grupo $gruposUsuarios = null)
    {
        $this->grupos_usuarios = $gruposUsuarios;

        return $this;
    }

    /**
     * Get gruposUsuarios
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGruposUsuarios()
    {
        return $this->grupos_usuarios;
    }


    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return GruposUsuarios
     */
    public function setGrupo(\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return GruposUsuarios
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set grupoId
     *
     * @param integer $grupoId
     *
     * @return GruposUsuarios
     */
    public function setGrupoId($grupoId)
    {
        $this->grupoId = $grupoId;

        return $this;
    }

    /**
     * Get grupoId
     *
     * @return integer
     */
    public function getGrupoId()
    {
        return $this->grupoId;
    }
}
