<?php
/**
 * Created by PhpStorm.
 * User: aydin
 * Date: 9/24/13
 * Time: 11:45 PM
 */

namespace MageMocker\Service;

use MageMocker\Entity\ProductConfig;
use Faker\Factory as FakerFactory;

class ProductService {

    protected $configObject;

    protected $faker;

    protected $messages = array();

    public function __constuct(ProductConfig $productConfig)
    {
        $this->productConfig = $productConfig;
        $this->faker = FakerFactory::create();

    }

    public function mock()
    {

        $config = $this->getConfigObject();
        $amount = $config->getAmount();

        for($i = 0; $i < $amount; $i++ ) {
            $product = Mage::getModel('catalog/product')
                ->setTypeId($config->getTypeId())
                ->setWebsiteIDs(array($config->getWebsiteId()))
                ->setStoreIDs(array($config->getStoreId()))
                ->setAttributeSetId($config->getAttributeSetId())
                ->setCategoryIds($config->getCategoryIds());

            $product
                ->setName($this->faker->sentence(4))
                ->setDescription($this->faker->text)
                ->setPrice($this->faker->randomDigitNotNull)
                ->setSku($this->faker->randomDigitNotNull)
                ->setWeight($this->faker->randomDigitNotNull)
                ->setTaxClassId(0)
                ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
                ->setStatus(1)
                ->setStockData(array(
                    'is_in_stock'   => 1,
                    'qty'           => 1,
                    'manage_stock'  => 1,
                ));

            $this->save($product);

        }

        return $this->messages;
    }

    public function save(Mage_Catalog_Model_Product $product)
    {
        try {
            $errors = $product->validate();
            if (is_array($errors)) {
                foreach ($errors as $code => $error) {
                    if($error === true) {
                        $this->messages[] = Mage::helper('catalog')->__('Attribute "%s" is invalid.', $code);
                    } else {
                        $this->messages[] = $error;
                    }

                }
            }
        } catch (Mage_Core_Exception $e) {
            $this->messages[] = $e->getMessage();
        }
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



} 