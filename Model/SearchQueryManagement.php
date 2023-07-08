<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Model;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Search\Model\ResourceModel\Query\CollectionFactory as RecommendationQueryCollectionFactoryy;
use AlbertMage\Search\Model\SearchQueryFactory;
use AlbertMage\Search\Model\ResourceModel\SearchQuery\CollectionFactory as SearchQueryCollectionFactory;
use AlbertMage\Customer\Api\Data\SocialAccountInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use AlbertMage\Search\Model\SearchQueryRepository;

/**
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SearchQueryManagement implements \AlbertMage\Search\Api\SearchQueryManagementInterface
{

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var RecommendationQueryCollectionFactoryy
     */
    protected $recommendationQueryCollectionFactoryy;

    /**
     * @var SearchQueryFactory
     */
    protected $searchQueryFactory;

    /**
     * @var SearchQueryCollectionFactory
     */
    protected $searchQueryCollectionFactory;

    /**
     * @var SocialAccountInterfaceFactory
     */
    protected $socialAccountInterfaceFactory;

    /**
     * @var SearchQueryRepository
     */
    protected $searchQueryRepository;

    /**
     * @param StoreManagerInterface $storeManager
     * @param RecommendationQueryCollectionFactoryy $recommendationQueryCollectionFactoryy
     * @param SearchQueryFactory $searchQueryFactory
     * @param SearchQueryCollectionFactory $searchQueryCollectionFactory
     * @param SocialAccountInterfaceFactory $socialAccountInterfaceFactory
     * @param SearchQueryRepository $searchQueryRepository
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        RecommendationQueryCollectionFactoryy $recommendationQueryCollectionFactoryy,
        SearchQueryFactory $searchQueryFactory,
        SearchQueryCollectionFactory $searchQueryCollectionFactory,
        SocialAccountInterfaceFactory $socialAccountInterfaceFactory,
        SearchQueryRepository $searchQueryRepository
    ) {
        $this->storeManager = $storeManager;
        $this->recommendationQueryCollectionFactoryy = $recommendationQueryCollectionFactoryy;
        $this->searchQueryFactory = $searchQueryFactory;
        $this->searchQueryCollectionFactory = $searchQueryCollectionFactory;
        $this->socialAccountInterfaceFactory = $socialAccountInterfaceFactory;
        $this->searchQueryRepository = $searchQueryRepository;
    }

    /**
     * @inheritDoc
     */
    public function getMineSearchQuery(int $customerId)
    {
        $collection = $this->searchQueryCollectionFactory->create();
        $collection->setPageSize(10);
        $collection->addFieldToFilter('customer_id', ['eq' => $customerId]);
        $collection->setOrder('updated_at', 'DESC');
        $items = [];
        foreach($collection->getItems() as $item) {
            $items[] = $item->getQueryText();
        }
        return $items;
    }

    /**
     * @inheritDoc
     */
    public function getGuestSearchQuery(string $guestToken)
    {
        $guest = $this->socialAccountInterfaceFactory->create()->load($guestToken, 'unique_hash');
        if (!$guest->getId()) {
            throw new NoSuchEntityException(
                __('Token doesn\'t exit.'),

            );
        }

        $collection = $this->searchQueryCollectionFactory->create();
        $collection->setPageSize(10);
        $collection->addFieldToFilter('guest_id', ['eq' => $guest->getId()]);
        $collection->setOrder('updated_at', 'DESC');
        $items = [];
        foreach($collection->getItems() as $item) {
            $items[] = $item->getQueryText();
        }
        return $items;
    }

    /**
     * @inheritDoc
     */
    public function createMineSearchQuery(int $customerId, string $queryText)
    {
        $queryText = trim($queryText);
        $collection = $this->searchQueryCollectionFactory->create();
        $collection->addFieldToFilter('customer_id', ['eq' => $customerId]);
        $collection->addFieldToFilter('query_text', ['eq' => $queryText]);
        if ($collection->getSize()) {
            $searchQuery = $collection->getFirstItem();
        } else {
            $searchQuery = $this->searchQueryFactory->create();
            $searchQuery->setCustomerId($customerId);
        }
        $searchQuery->setQueryText($queryText);
        $searchQuery->setUpdatedAt(time());
        $searchQuery->save();
        return true;
    }

    /**
     * @inheritDoc
     */
    public function createGuestSearchQuery(string $guestToken, string $queryText)
    {
        $queryText = trim($queryText);
        $guest = $this->socialAccountInterfaceFactory->create()->load($guestToken, 'unique_hash');
        if (!$guest->getId()) {
            throw new NoSuchEntityException(
                __('Token doesn\'t exit.'),

            );
        }

        $collection = $this->searchQueryCollectionFactory->create();
        $collection->addFieldToFilter('guest_id', ['eq' => $guest->getId()]);
        $collection->addFieldToFilter('query_text', ['eq' => $queryText]);
        if ($collection->getSize()) {
            $searchQuery = $collection->getFirstItem();
        } else {
            $searchQuery = $this->searchQueryFactory->create();
            $searchQuery->setGuestId($guest->getId());
        }
        $searchQuery->setQueryText($queryText);
        $searchQuery->setUpdatedAt(time());
        $searchQuery->save();
        return true;

    }

    /**
     * @inheritDoc
     */
    public function cleanCustomerSearchQuery(int $customerId)
    {
        $collection = $this->searchQueryCollectionFactory->create();
        $collection->addFieldToFilter('customer_id', ['eq' => $customerId]);
        foreach($collection->getItems() as $item) {
            $item->delete();
        }
    }

    /**
     * @inheritDoc
     */
    public function cleanGuestSearchQuery(string $guestToken)
    {
        $queryText = trim($queryText);
        $guest = $this->socialAccountInterfaceFactory->create()->load($guestToken, 'unique_hash');
        if (!$guest->getId()) {
            throw new NoSuchEntityException(
                __('Token doesn\'t exit.'),

            );
        }

        $collection = $this->searchQueryCollectionFactory->create();
        $collection->addFieldToFilter('guest_id', ['eq' => $guest->getId()]);
        foreach($collection->getItems() as $item) {
            $item->delete();
        }
    }

    /**
     * @inheritDoc
     */
    public function getRecommendationSearchQuery()
    {
        $collection = $this->recommendationQueryCollectionFactoryy->create();
        $items = [];
        foreach ($collection->getItems() as $item) {
            $items[] = $item->getQueryText();
        }
        return $items;
    }


}