<?php

namespace MageMocker\Service;

/**
 * Class MagentoService
 * @package MageMocker\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class MagentoService {

    /**
     * @var string
     */
    protected $appFile;

    /**
     * @param string $appFile
     */
    public function __construct($appFile) {
       $this->appFile = (string) $appFile;
    }

    /**
     * @return bool
     */
    public function validate() {
        return is_readable($this->getAppFile());
    }

    /**
     * Bootstrap Magento Application
     */
    public function bootstrap() {
        require_once $this->getAppFile();
        Mage::setIsDeveloperMode(true);
        umask(0);
        Mage::app();
        Mage::app()
            ->setCurrentStore(Mage::getModel('core/store')
            ->load(Mage_Core_Model_App::ADMIN_STORE_ID));
    }

    /**
     * @param string $appFile
     */
    public function setAppFile($appFile)
    {
        $this->appFile = (string) $appFile;
    }

    /**
     * @return string
     */
    public function getAppFile()
    {
        return $this->appFile;
    }
} 