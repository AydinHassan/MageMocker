<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Application;
use MageMocker\Command\ProductCommand;
use Zend\Stdlib\Hydrator\ClassMethods;
use MageMocker\Entity\ProductConfig;
use MageMocker\Service\ProductService;

class Mocker {

    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->application->add(new ProductCommand(
            new ClassMethods(),
            new ProductService(),
            new ProductConfig()
        ));


        $application->run();
    }

} 