<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use MageMocker\Service\ServiceInterface;
use MageMocker\Entity\ConfigInterface;

/**
 * Class AbstractCommand
 * @package MageMocker\Command
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
abstract class AbstractCommand extends SymfonyCommand {

    /**
     * @var \Zend\Stdlib\Hydrator\ClassMethods
     */
    protected $hydrator;

    /**
     * @var \MageMocker\Service\ServiceInterface
     */
    protected $service;

    /**
     * @var \MageMocker\Entity\ConfigInterface
     */
    protected $configObject;

    /**
     * @param \Zend\Stdlib\Hydrator\ClassMethods $hydrator
     * @param \MageMocker\Service\ServiceInterface $service
     * @param \MageMocker\Entity\ConfigInterface $configObject
     */
    public function __construct(
        ClassMethods $hydrator,
        ServiceInterface $service,
        ConfigInterface $configObject
    ) {
        $this->hydrator     = $hydrator;
        $this->service      = $service;
        $this->configObject = $configObject;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getHydrator()->hydrate($input->getArguments(), $this->getConfigObject());
        $this->getService()->setConfigObject($this->getConfigObject());
        $messages = $this->getService()->mock();

        foreach($messages as $message) {
            $output->writeln('<error>' . $message . '</error>');
        }
    }

    /**
     * @param \Zend\Stdlib\Hydrator\ClassMethods $hydrator
     * @return $this
     */
    public function setHydrator(ClassMethods $hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @return \Zend\Stdlib\Hydrator\ClassMethods
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param \MageMocker\Entity\ConfigInterface $configObject
     * @return $this
     */
    public function setConfigObject(ConfigInterface $configObject)
    {
        $this->configObject = $configObject;
        return $this;
    }

    /**
     * @return \MageMocker\Entity\ConfigInterface
     */
    public function getConfigObject()
    {
        return $this->configObject;
    }

    /**
     * @param \MageMocker\Service\ServiceInterface $service
     * @return $this
     */
    public function setService(ServiceInterface $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return \MageMocker\Service\ServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }
} 