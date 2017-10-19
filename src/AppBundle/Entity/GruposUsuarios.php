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
     * Set grupoUsuario
     *
     * @param \AppBundle\Entity\Grupo $grupoUsuario
     *
     * @return GruposUsuarios
     */
    public function setGrupoUsuario(\AppBundle\Entity\Grupo $grupoUsuario = null)
    {
        $this->grupo_usuario = $grupoUsuario;

        return $this;
    }

    /**
     * Get grupoUsuario
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGrupoUsuario()
    {
        return $this->grupo_usuario;
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
}
