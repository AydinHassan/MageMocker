<?php

namespace MageMocker\Command;

use MageMocker\Service\MagentoService;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use MageMocker\Service\ServiceInterface;
use MageMocker\Entity\ConfigInterface;
use Symfony\Component\Console\Input\InputArgument;

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
     * @param ClassMethods $hydrator
     * @param ServiceInterface $service
     * @param ConfigInterface $configObject
     * @param MagentoService $magentoService
     */
    public function __construct(
        ClassMethods $hydrator,
        ServiceInterface $service,
        ConfigInterface $configObject,
        MagentoService $magentoService
    ) {
        $this->hydrator         = $hydrator;
        $this->service          = $service;
        $this->configObject     = $configObject;
        $this->magentoService   = $magentoService;
        parent::__construct();
    }

    protected function configure() {
        $this->addArgument(
            'app_path',
            InputArgument::REQUIRED,
            'Magento Application Path'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $path = $input->getArgument('app_path');
        $mageService = $this->getMagentoService()
                            ->setAppDir($path);

        if(!$mageService->validate()) {
            $output->writeln('<error>Directory given is not a valid Magento Install</error>');
            $output->writeln('<error>Cannot find app/Mage.php. </error>');
            return;
        }

        $mageService->bootstrap();

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

    /**
     * @return \MageMocker\Service\MagentoService
     */
    public function getMagentoService()
    {
        return $this->magentoService;
    }

    /**
     * @param \MageMocker\Service\MagentoService $magentoService
     * @return $this
     */
    public function setMagentoService($magentoService)
    {
        $this->magentoService = $magentoService;
        return $this;
    }


} 