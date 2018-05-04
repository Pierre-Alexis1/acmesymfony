<?php

namespace AppBundle\Service;

/**
 * Class FortuneMessageGenerator
 * @package AppBundle\Service
 */
class FortuneMessageGenerator
{
    /**
     * @var array
     */
    protected $messages;

    /**
     * Initialisation des messages
     */
    public function __construct()
    {
        $this->messages = [
            'Si t\'est con, t\'es con',
            'Va te faire',
            'PD',
        ];
    }

    /**
     * @return string
     */
    public function generate()
    {
        $i = mt_rand(0, count($this->messages) - 1);

        return $this->messages[$i];
    }
}
