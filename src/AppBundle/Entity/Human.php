<?php

namespace AppBundle\Entity;

abstract class Human
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Human
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
