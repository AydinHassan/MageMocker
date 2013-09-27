<?php

namespace MageMocker\Service;

use MageMocker\Entity\ConfigInterface;

/**
 * Interface ServiceInterface
 * @package MageMocker\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
interface ServiceInterface {

    /**
     * Save objects
     */
    //function save();

    /**
     * Generate Mocks
     */
    function mock();

    /**
     * Set the config object
     * @param ConfigInterface $config
     */
    function setConfigObject(ConfigInterface $config);

    /**
     * Get the config object
     */
    function getConfigObject();
} 