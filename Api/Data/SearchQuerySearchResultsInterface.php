<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Api\Data;

/**
 * Interface for node search results.
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface SearchQuerySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get node list.
     *
     * @return string[]
     */
    public function getItems();

    /**
     * Set node list.
     *
     * @param string[] $items
     * @return $this
     */
    public function setItems(array $items);
}
