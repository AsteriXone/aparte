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

    /**
     * @ORM\OneToMany(targetEntity="Cuadrante", mappedBy="grupo")
     */
    protected $cuadrantes;

    /**
     * @ORM\OneToMany(targetEntity="GrupoMuestra", mappedBy="grupo")
     */
    private $gruposMuestras;

    public function __construct()
    {
        $this->gruposMuestras = new ArrayCollection();
        $this->grupos_usuarios = new ArrayCollection();
        $this->cuadrantes = new ArrayCollection();
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

//    public function getGupo()
//    {
//        return $this;
//    }
    /**
     * Add cuadrante
     *
     * @param \AppBundle\Entity\Cuadrante $cuadrante
     *
     * @return Grupo
     */
    public function addCuadrante(\AppBundle\Entity\Cuadrante $cuadrante)
    {
        $this->cuadrantes[] = $cuadrante;

        return $this;
    }

    /**
     * Remove cuadrante
     *
     * @param \AppBundle\Entity\Cuadrante $cuadrante
     */
    public function removeCuadrante(\AppBundle\Entity\Cuadrante $cuadrante)
    {
        $this->cuadrantes->removeElement($cuadrante);
    }

    /**
     * Get cuadrantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCuadrantes()
    {
        return $this->cuadrantes;
    }

    /**
     * Add gruposMuestra
     *
     * @param \AppBundle\Entity\GrupoMuestra $gruposMuestra
     *
     * @return Grupo
     */
    public function addGruposMuestra(\AppBundle\Entity\GrupoMuestra $gruposMuestra)
    {
        $this->gruposMuestras[] = $gruposMuestra;

        return $this;
    }

    /**
     * Remove gruposMuestra
     *
     * @param \AppBundle\Entity\GrupoMuestra $gruposMuestra
     */
    public function removeGruposMuestra(\AppBundle\Entity\GrupoMuestra $gruposMuestra)
    {
        $this->gruposMuestras->removeElement($gruposMuestra);
    }

    /**
     * Get gruposMuestras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGruposMuestras()
    {
        return $this->gruposMuestras;
    }
}
