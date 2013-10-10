<?php

namespace MageMocker\Service;

/**
 * Class ProductService
 * @package MageMocker\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ProductService extends AbstractService implements ServiceInterface {



    /**
     * Generate fake products
     * @return array
     */
    public function mock()
    {

        $config = $this->getConfigObject();
        $amount = $config->getAmount();

        for($i = 0; $i < $amount; $i++ ) {
            $product = \Mage::getModel('catalog/product')
                ->setTypeId($config->getTypeId())
                ->setWebsiteIDs(array($config->getWebsiteId()))
                ->setStoreIDs(array($config->getStoreId()))
                ->setAttributeSetId($config->getAttributeSetId())
                ->setCategoryIds($config->getCategoryIds());

            $product
                ->setName($this->faker->sentence(4))
                ->setDescription($this->faker->text)
                ->setPrice($this->faker->randomDigitNotNull)
                ->setWeight($this->faker->randomDigitNotNull)
                ->setTaxClassId(0)
                ->setVisibility(\Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
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

    /**
     * Save Product
     * @param Mage_Catalog_Model_Product $product
     */
    public function save( $product)
    {
        try {
            $errors = $product->validate();

            if (is_array($errors)) {
                foreach ($errors as $code => $error) {
                    if($error === true) {
                        $this->messages[] = \Mage::helper('catalog')->__('Attribute "%s" is invalid.', $code);
                    } else {
                        $this->messages[] = $error;
                    }

                }
            } else {
                $product->save();
            }
        } catch (\Mage_Core_Exception $e) {
            $this->messages[] = $e->getMessage();
            var_dump($this->messages);
        }
    }
} 