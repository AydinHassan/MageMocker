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
    protected $appDir = '';

    /**
     * @return bool
     */
    public function validate() {
        return is_readable($this->getAppDir());
    }

    /**
     * Bootstrap Magento Application
     */
    public function bootstrap() {
        require_once $this->getAppDir() . '/app/Mage.php';
        \Mage::app('admin');
    }

    /**
     * @param $appDir
     * @return $this
     */
    public function setAppDir($appDir)
    {
        $this->appDir = (string) $appDir;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppDir()
    {
        return $this->appDir;
    }
} 