<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
declare(strict_types=1);

namespace AlbertMage\Search\Model;

use AlbertMage\Search\Api\Data\NotificationSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with SearchQuery search results.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SearchQuerySearchResults extends SearchResults implements NotificationSearchResultsInterface
{
}
