<?php

namespace MageMocker\Command;

/**
 * Interface CommandInterface
 * @package MageMocker\Command
 */
interface CommandInterface {

    /**
     * Set up Command
     * @return mixed
     */
    function configure();

} 