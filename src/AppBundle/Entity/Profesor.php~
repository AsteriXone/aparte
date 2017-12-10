<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profesor
 *
 * @ORM\Table(name="profesor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfesorRepository")
 */
class Profesor
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_1", type="string", length=255)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_2", type="string", length=255)
     */
    private $apellido2;

    /**
     * @ORM\OneToMany(targetEntity="GrupoProfesor", mappedBy="profesor")
     */
    private $grupos_profesores;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosProfes", mappedBy="profesor")
     */
    private $usuarios_profes;

    public function __toString()
    {
        return (string) $this->getNombre()." ".$this->getApellido1()." ".$this->getApellido2();
    }

    public function __construct()
    {
        $this->grupos_profesores = new ArrayCollection();
        $this->usuarios_profesores = new ArrayCollection();
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
     * @return Profesor
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
     * Set apellido1
     *
     * @param string $apellido1
     *
     * @return Profesor
     */
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     *
     * @return Profesor
     */
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Add gruposProfesore
     *
     * @param \AppBundle\Entity\GrupoProfesor $gruposProfesore
     *
     * @return Profesor
     */
    public function addGruposProfesore(\AppBundle\Entity\GrupoProfesor $gruposProfesore)
    {
        $this->grupos_profesores[] = $gruposProfesore;

        return $this;
    }

    /**
     * Remove gruposProfesore
     *
     * @param \AppBundle\Entity\GrupoProfesor $gruposProfesore
     */
    public function removeGruposProfesore(\AppBundle\Entity\GrupoProfesor $gruposProfesore)
    {
        $this->grupos_profesores->removeElement($gruposProfesore);
    }

    /**
     * Get gruposProfesores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGruposProfesores()
    {
        return $this->grupos_profesores;
    }

    /**
     * Add usuariosProfe
     *
     * @param \AppBundle\Entity\UsuariosProfes $usuariosProfe
     *
     * @return Profesor
     */
    public function addUsuariosProfe(\AppBundle\Entity\UsuariosProfes $usuariosProfe)
    {
        $this->usuarios_profes[] = $usuariosProfe;

        return $this;
    }

    /**
     * Remove usuariosProfe
     *
     * @param \AppBundle\Entity\UsuariosProfes $usuariosProfe
     */
    public function removeUsuariosProfe(\AppBundle\Entity\UsuariosProfes $usuariosProfe)
    {
        $this->usuarios_profes->removeElement($usuariosProfe);
    }

    /**
     * Get usuariosProfes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosProfes()
    {
        return $this->usuarios_profes;
    }

    /**
     * Add usuariosProfesore
     *
     * @param \AppBundle\Entity\UsuariosProfes $usuariosProfesore
     *
     * @return Profesor
     */
    public function addUsuariosProfesore(\AppBundle\Entity\UsuariosProfes $usuariosProfesore)
    {
        $this->usuarios_profesores[] = $usuariosProfesore;

        return $this;
    }

    /**
     * Remove usuariosProfesore
     *
     * @param \AppBundle\Entity\UsuariosProfes $usuariosProfesore
     */
    public function removeUsuariosProfesore(\AppBundle\Entity\UsuariosProfes $usuariosProfesore)
    {
        $this->usuarios_profesores->removeElement($usuariosProfesore);
    }

    /**
     * Get usuariosProfesores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosProfesores()
    {
        return $this->usuarios_profesores;
    }
}
