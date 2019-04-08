<?php
/**
 * Created by PhpStorm.
 * User: SYSTEM
 * Date: 16/08/2018
 * Time: 19:51
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PremiereDetail
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="PremiereDetail")
 * @ORM\HasLifecycleCallbacks
 */
class PremiereDetail implements CinemaEntity
{

    use CreationDate;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(
     *     type="bigint",
     *     name="premiereDetailId",
     *     nullable=false,
     *     options={"unsigned":false}
     * )
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $premiereDetailId;

    /**
     * @var string
     *
     * @ORM\Column(
     *     type="string",
     *     length=200,
     *     name="observation",
     *     nullable=false,
     *     options={"fixed":false}
     * )
     */
    private $observation;

    /**
     * @var Premiere
     *
     * @ORM\ManyToOne(targetEntity="Premiere", inversedBy="details", fetch="EXTRA_LAZY", cascade={"all"})
     * @ORM\JoinColumn(name="premiereId", referencedColumnName="premiereId")
     */
    private $premiere;


    /**
     * @return int
     */
    public function getPremiereDetailId(): int
    {
        return $this->premiereDetailId;
    }

    /**
     * @param string $observation
     * @return PremiereDetail
     */
    public function setObservation(string $observation): PremiereDetail
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return string
     */
    public function getObservation(): string
    {
        return $this->observation;
    }

    /**
     * @param Premiere $premiere
     * @return PremiereDetail
     */
    public function setPremiere(Premiere $premiere): PremiereDetail
    {
        $this->premiere = $premiere;

        return $this;
    }

    /**
     * @return Premiere
     */
    public function getPremiere(): Premiere
    {
        return $this->premiere;
    }

}