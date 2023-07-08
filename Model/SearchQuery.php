<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Model;

use Magento\Framework\Model\AbstractModel;
use AlbertMage\Search\Api\Data\SearchQueryInterface;

/**
 * Class SearchQuery
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SearchQuery extends AbstractModel implements SearchQueryInterface
{
    
    /**
     * Initialize SearchQuery model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AlbertMage\Search\Model\ResourceModel\SearchQuery::class);
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get query text
     *
     * @return string
     */
    public function getQueryText()
    {
        return $this->getData(self::QUERY_TEXT);
    }

    /**
     * Set query text
     *
     * @param string $queryText
     * @return $this
     */
    public function setQueryText($queryText)
    {
        return $this->setData(self::QUERY_TEXT, $queryText);
    }

    /**
     * Get storeId
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set storeId
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Set customerId
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get guestId
     *
     * @return int
     */
    public function getGuestId()
    {
        return $this->getData(self::GUEST_ID);
    }

    /**
     * Set guestId
     *
     * @param int $guestId
     * @return $this
     */
    public function setGuestId($guestId)
    {
        return $this->setData(self::GUEST_ID, $guestId);
    }

    /**
     * Load Query object by query string
     *
     * @param string $text
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     * @deprecated 100.1.0 "synonym for" feature has been removed
     */
    public function loadByQuery($text)
    {
        $this->load($text, 'query_text');
        return $this;
    }
}
