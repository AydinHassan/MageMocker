<?php
/**
 * Created by PhpStorm.
 * User: aydin
 * Date: 9/24/13
 * Time: 10:50 PM
 */

namespace MageMocker\Service;


class MagentoService {

    protected $appFile;

    public function __construct($appFile) {
       $this->appFile = $appFile;
    }

    public function validate() {
        return is_readable($this->getAppFile());
    }

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
     * @param mixed $appFile
     */
    public function setAppFile($appFile)
    {
        $this->appFile = $appFile;
    }

    /**
     * @return mixed
     */
    public function getAppFile()
    {
        return $this->appFile;
    }


} 