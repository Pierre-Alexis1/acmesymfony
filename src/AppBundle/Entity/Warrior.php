<?php

namespace AppBundle\Entity;

class Warrior extends Human
{
    /**
     * @var int
     */
    protected $rage;

    /**
     * @return int
     */
    public function getRage()
    {
        return $this->rage;
    }

    /**
     * @param int $rage
     *
     * @return Warrior
     */
    public function setRage($rage)
    {
        $this->rage = $rage;

        return $this;
    }
}
