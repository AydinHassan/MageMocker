<?php

namespace MageMocker\Command;

use MageMocker\Service\MagentoService;
use Symfony\Component\Console\Application;
use Zend\Stdlib\Hydrator\ClassMethods;
use MageMocker\Command\ProductCommand;
use MageMocker\Entity\ProductConfig;
use MageMocker\Service\ProductService;
use MageMocker\Command\AddToCartCommand;
use MageMocker\Entity\AddToCartConfig;
use MageMocker\Service\AddToCartService;

/**
 * Class Mocker
 * @package MageMocker\Command
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class Mocker {

    /**
     * @var \Symfony\Component\Console\Application
     */
    protected $application;

    /**
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->application->add(new ProductCommand(
            new ClassMethods(),
            new ProductService(),
            new ProductConfig(),
            new MagentoService()
        ));

        $this->application->add(new AddToCartCommand(
            new ClassMethods(),
            new AddToCartService(),
            new AddToCartConfig(),
            new MagentoService()
        ));

        $this->application->run();
    }

} 