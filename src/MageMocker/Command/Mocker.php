<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Application;
use MageMocker\Command\ProductCommand;

class Mocker {

    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
        $this->application->add(new ProductCommand());
        $application->run();
    }

} 