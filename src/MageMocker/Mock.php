<?php

namespace MageMocker;
require __DIR__ . '/../../vendor/autoload.php';

use MageMocker\Service\MagentoService;
use MageMocker\Command\Product;
use MageMocker\Command\Mocker;
use Symfony\Component\Console\Application;

$magentoAppFile = getcwd() . 'app/Mage.php';
$mageService = new MagentoService($magentoAppFile);
if(!$mageService->validate()) {
    echo "Cannot find app/Mage.php. Are you in a root Magento install?\n\n";
    exit();
}

$mageService->bootstrap();
$mocker = new Mocker(new Application());







