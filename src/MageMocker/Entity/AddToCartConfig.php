<?php

namespace MageMocker\Entity;

use MageMocker\Entity\ConfigInterface;

/**
 * Class AddToCartConfig
 * @package MageMocker\Entity
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class AddToCartConfig implements ConfigInterface
{

    /**
     * @var int
     */
    protected $productId;

    /**
     * @var int
     */
    protected $qty;

    /**
     * @param int $productId
     */
    public function setProductId($productId)
    {
        $this->productId = (int) $productId;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $qty
     */
    public function setQty($qty)
    {
        $this->qty = (int) $qty;
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

}