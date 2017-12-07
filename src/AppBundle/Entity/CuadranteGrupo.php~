<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CuadranteGrupo
 *
 * @ORM\Table(name="cuadrante_grupo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CuadranteGrupoRepository")
 */
class CuadranteGrupo
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
     * @ORM\ManyToOne(targetEntity="Cuadrante", inversedBy="cuadranteGrupo")
     */
    private $cuadrante;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="cuadranteGrupo")
     */
    private $grupo;


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
     * Set cuadrante
     *
     * @param \AppBundle\Entity\Cuadrante $cuadrante
     *
     * @return CuadranteGrupo
     */
    public function setCuadrante(\AppBundle\Entity\Cuadrante $cuadrante = null)
    {
        $this->cuadrante = $cuadrante;

        return $this;
    }

    /**
     * Get cuadrante
     *
     * @return \AppBundle\Entity\Cuadrante
     */
    public function getCuadrante()
    {
        return $this->cuadrante;
    }

    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return CuadranteGrupo
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
}
