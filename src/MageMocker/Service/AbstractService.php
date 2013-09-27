<?php

namespace MageMocker\Service;

use MageMocker\Entity\ConfigInterface;
use Faker\Factory as FakerFactory;
use Faker\Generator;

/**
 * Class AbstractService
 * @package MageMocker\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class AbstractService {

    /**
     * @var \MageMocker\Entity\ConfigInterface
     */
    protected $configObject;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * @var array
     */
    protected $messages = array();

    /**
     * @param ConfigInterface $configObject
     */
    public function __constuct(ConfigInterface $configObject)
    {
        $this->configObject = $configObject;
        $this->faker = FakerFactory::create();
    }

    /**
     * @param \MageMocker\Entity\ConfigInterface $configObject
     */
    public function setConfigObject(ConfigInterface $configObject)
    {
        $this->configObject = $configObject;
    }

    /**
     * @return \MageMocker\Entity\ConfigInterface
     */
    public function getConfigObject()
    {
        return $this->configObject;
    }

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param \Faker\Generator $faker
     */
    public function setFaker(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @return \Faker\Generator
     */
    public function getFaker()
    {
        return $this->faker;
    }
} 