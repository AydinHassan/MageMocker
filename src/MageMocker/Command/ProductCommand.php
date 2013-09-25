<?php

namespace MageMocker\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use MageMocker\Entity\ProductConfig;
use MageMocker\Service\ProductService;

class ProductCommand extends SymfonyCommand
{

    protected $hydrator;

    protected $service;

    protected $configObject;

    public function __construct(
        ClassMethods $hydrator,
        ProductService $productService,
        ProductConfig $productConfig
    ) {
        $this->hydrator     = $hydrator;
        $this->service      = $productService;
        $this->configObject = $productConfig;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('magemocker:product')
             ->setDescription('Create Fake Magento products')
             ->addArgument(
                 'type_id',
                 InputArgument::REQUIRED,
                 'Product Type Id'
             )
             ->addArgument(
                 'website_id',
                 InputArgument::REQUIRED,
                 'Website Id'
             )
             ->addArgument(
                 'store_id',
                 InputArgument::REQUIRED,
                 'Store Id'
             )
             ->addArgument(
                 'attribute_set_id',
                 InputArgument::REQUIRED,
                 'Attribute Set Id'
             )
             ->addArgument(
                 'category_ids',
                 InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                 "Category Id's To assign the product to (separate multiple ID's with a space)"
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$productConfig = new ProductConfig();
        $this->getHydrator()->hydrate($input->getArguments(), $this->getConfigObject());
        $this->getService()->setConfigObject($this->getConfigObject());
        $this->getService()->mock();

        //echo messages
    }

    /**
     * @param \Zend\Stdlib\Hydrator\ClassMethods $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return \Zend\Stdlib\Hydrator\ClassMethods
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param mixed $configObject
     */
    public function setConfigObject($configObject)
    {
        $this->configObject = $configObject;
    }

    /**
     * @return mixed
     */
    public function getConfigObject()
    {
        return $this->configObject;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }



} 