<?php

namespace MageMocker\Entity;

/**
 * Class ProductConfig
 * @package MageMocker\Entity
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class ProductConfig implements ConfigInterface
{

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var int
     */
    protected $typeId;

    /**
     * @var int
     */
    protected $websiteId;

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var int
     */
    protected $attributeSetId;

    /**
     * @var array
     */
    protected $categoryIds;

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (int) $amount;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $attributeSetId
     */
    public function setAttributeSetId($attributeSetId)
    {
        $this->attributeSetId = (int) $attributeSetId;
    }

    /**
     * @return int
     */
    public function getAttributeSetId()
    {
        return $this->attributeSetId;
    }

    /**
     * @param int $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = (int) $storeId;
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param int $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = (int) $typeId;
    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param int $websiteId
     */
    public function setWebsiteId($websiteId)
    {
        $this->websiteId = (int) $websiteId;
    }

    /**
     * @return int
     */
    public function getWebsiteId()
    {
        return $this->websiteId;
    }

    /**
     * @param array $categoryIds
     */
    public function setCategoryIds(array $categoryIds)
    {
        $this->categoryIds = $categoryIds;
    }

    /**
     * @return array
     */
    public function getCategoryIds()
    {
        return $this->categoryIds;
    }

}