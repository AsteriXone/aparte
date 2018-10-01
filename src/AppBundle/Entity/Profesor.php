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
     * @ORM\Column(name="cargo", type="string", length=255)
     */
    private $cargo;


    /**
     * @var int
     *
     */
    private $estado;

    /**
     * @var int
     *
     */
    private $numeroVotos;

    /**
     * @ORM\OneToMany(targetEntity="GrupoProfesor", mappedBy="profesor", cascade={"persist", "remove"})
     */
    private $grupos_profesores;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosProfes", mappedBy="profesor")
     */
    private $usuarios_profes;

    public function __toString()
    {
        return (string) $this->getNombre(). " - " . $this->getCargo();
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

    
    public function getEstado()
    {
        return $this->estado;
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

    /**
     * Set estado
     *
     * @param int $estado
     *
     * @return Profesor
     */
    public function setNumeroVotos($votos)
    {
        $this->numeroVotos = $votos;

        return $this;
    }

    /**
     * Get estado
     *
     * @return int
     */
    public function getNumeroVotos()
    {
        return $this->numeroVotos;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     *
     * @return Profesor
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }
}
