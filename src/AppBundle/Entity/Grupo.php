<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="grupo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GrupoRepository")
 */
class Grupo
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
     * @var string
     *
     * @ORM\Column(name="codigo_grupo", type="string", length=255, unique=true)
     */
    private $codigoGrupo;

    /**
     * @var int
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @ORM\ManyToOne(targetEntity="Universidad", inversedBy="grupo")
     */
    private $universidad;

    /**
     * @ORM\ManyToOne(targetEntity="Especialidad", inversedBy="grupo")
     */
    private $especialidad;

    /**
     * @ORM\OneToMany(targetEntity="GruposUsuarios", mappedBy="grupo")
     */
    private $grupos_usuarios;

    public function __construct()
    {
        $this->grupos_usuarios = new ArrayCollection();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string) $this->getUniversidad(). " - ".$this->getEspecialidad(). " (" . $this->getAnio().")";
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
     * Add user
     *
     * @param \AppBundle\Entity\Usuario $user
     *
     * @return Grupo
     */
    public function addUser(\AppBundle\Entity\Usuario $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Usuario $user
     */
    public function removeUser(\AppBundle\Entity\Usuario $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add grupo
     *
     * @param \AppBundle\Entity\GruposUsuarios $grupo
     *
     * @return Grupo
     */
    public function addGrupo(\AppBundle\Entity\GruposUsuarios $grupo)
    {
        $this->grupos[] = $grupo;

        return $this;
    }

    /**
     * Remove grupo
     *
     * @param \AppBundle\Entity\GruposUsuarios $grupo
     */
    public function removeGrupo(\AppBundle\Entity\GruposUsuarios $grupo)
    {
        $this->grupos->removeElement($grupo);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Set codigoGrupo
     *
     * @param string $codigoGrupo
     *
     * @return Grupo
     */
    public function setCodigoGrupo($codigoGrupo)
    {
        $this->codigoGrupo = $codigoGrupo;

        return $this;
    }

    /**
     * Get codigoGrupo
     *
     * @return string
     */
    public function getCodigoGrupo()
    {
        return $this->codigoGrupo;
    }

    /**
     * Set especialidad
     *
     * @param \AppBundle\Entity\Especialidad $especialidad
     *
     * @return Grupo
     */
    public function setEspecialidad(\AppBundle\Entity\Especialidad $especialidad = null)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set universidad
     *
     * @param \AppBundle\Entity\Universidad $universidad
     *
     * @return Grupo
     */
    public function setUniversidad(\AppBundle\Entity\Universidad $universidad = null)
    {
        $this->universidad = $universidad;

        return $this;
    }

    /**
     * Get universidad
     *
     * @return \AppBundle\Entity\Universidad
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }

    /**
     * Add gruposUsuario
     *
     * @param \AppBundle\Entity\GruposUsuarios $gruposUsuario
     *
     * @return Grupo
     */
    public function addGruposUsuario(\AppBundle\Entity\GruposUsuarios $gruposUsuario)
    {
        $this->grupos_usuarios[] = $gruposUsuario;

        return $this;
    }

    /**
     * Remove gruposUsuario
     *
     * @param \AppBundle\Entity\GruposUsuarios $gruposUsuario
     */
    public function removeGruposUsuario(\AppBundle\Entity\GruposUsuarios $gruposUsuario)
    {
        $this->grupos_usuarios->removeElement($gruposUsuario);
    }

    /**
     * Get gruposUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGruposUsuarios()
    {
        return $this->grupos_usuarios;
    }

    /**
     * Set anio
     *
     * @param integer $anio
     *
     * @return Grupo
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer
     */
    public function getAnio()
    {
        return $this->anio;
    }
}
