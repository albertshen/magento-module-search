<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Api;

/**
 * Interface for SearchQueryManagement.
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface SearchQueryManagementInterface
{
    /**
     * Get mine search query history.
     *
     * @param int $customerId
     * @return string[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMineSearchQuery(int $customerId);

    /**
     * Get guest search query history.
     *
     * @param string $guestToken
     * @return string[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getGuestSearchQuery(string $guestToken);

    /**
     * Create mine search query history.
     *
     * @param int $customerId
     * @param string $queryText
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createMineSearchQuery(int $customerId, string $queryText);

    /**
     * Create guest search query history.
     *
     * @param string $guestToken
     * @param string $queryText
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createGuestSearchQuery(string $guestToken, string $queryText);

    /**
     * Clean customer search query history.
     *
     * @param int $customerId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function cleanCustomerSearchQuery(int $customerId);

    /**
     * Clean guest search query history.
     *
     * @param string $guestToken
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function cleanGuestSearchQuery(string $guestToken);

    /**
     * Get recommendation search query.
     *
     * @return string[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getRecommendationSearchQuery();


}