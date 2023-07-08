<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Api;

/**
 * SearchQuery CRUD interface.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface SearchQueryRepositoryInterface
{
    /**
     * Save searchQuery.
     *
     * @param \AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery
     * @return \AlbertMage\Search\Api\Data\SearchQueryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery);

    /**
     * Delete searchQuery.
     *
     * @param \AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery
     * @return \AlbertMage\Search\Api\Data\SearchQueryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery);

    /**
     * Retrieve searchQuery.
     *
     * @param int $searchQueryId
     * @return \AlbertMage\Search\Api\Data\SearchQueryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($searchQueryId);

    /**
     * Retrieve searchQuery matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
