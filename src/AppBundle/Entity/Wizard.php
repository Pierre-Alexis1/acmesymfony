<?php

namespace AppBundle\Entity;

class Wizard extends Human
{
    /**
     * @var int
     */
    protected $magic;

    /**
     * @return int
     */
    public function getMagic()
    {
        return $this->magic;
    }

    /**
     * @param int $magic
     *
     * @return Wizard
     */
    public function setMagic($magic)
    {
        $this->magic = $magic;

        return $this;
    }
}
