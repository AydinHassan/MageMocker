<?php

namespace MageMocker\Service;

use MageMocker\Service\ServiceInterface;

/**
 * Class AddToCartService
 * @package MageMocker\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class AddToCartService extends AbstractService implements ServiceInterface {

    /**
     * Add product to cart
     */
    public function mock()
    {

        $config     = $this->getConfigObject();
        $cart       = \Mage::getSingleton('checkout/cart');
        $product    = new \Mage_Catalog_Model_Product();

        $product->load($config->getProductId());

        $cart->addProduct($product, array('qty' => $config->getQty()));
        $cart->save();
    }

    /**
     * Save Cart
     * @param $cart
     */
    public function save($cart)
    {
        $cart->save();
    }

} 