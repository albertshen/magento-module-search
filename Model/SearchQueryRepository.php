<?php
/**
 * SearchQuery entity resource model
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use AlbertMage\Search\Api\Data\SearchQueryInterface;
use AlbertMage\Search\Api\Data\SearchQueryInterfaceFactory;
use AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterfaceFactory;
use AlbertMage\Search\Model\ResourceModel\SearchQuery;
use AlbertMage\Search\Model\ResourceModel\SearchQuery\CollectionFactory;

/**
 * SearchQuery repository.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class SearchQueryRepository implements \AlbertMage\Search\Api\SearchQueryRepositoryInterface
{

    /**
     * @var \AlbertMage\Search\Model\SearchQueryFactory
     */
    protected $searchQueryFactory;

    /**
     * @var \AlbertMage\Search\Model\ResourceModel\SearchQuery
     */
    protected $searchQueryResourceModel;

    /**
     * @var \AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterfaceFactory
     */
    protected $searchQuerySearchResultsFactory;

    /**
     * @var \AlbertMage\Search\Model\ResourceModel\SearchQuery\CollectionFactory
     */
    protected $searchQueryCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param \AlbertMage\Search\Model\SearchQueryFactory $searchQueryFactory
     * @param \AlbertMage\Search\Model\ResourceModel\SearchQuery $searchQueryResourceModel
     * @param \AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterfaceFactory $searchQuerySearchResultsFactory
     * @param \AlbertMage\Search\Model\ResourceModel\SearchQuery\CollectionFactory $searchQueryCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \AlbertMage\Search\Model\SearchQueryFactory $searchQueryFactory,
        \AlbertMage\Search\Model\ResourceModel\SearchQuery $searchQueryResourceModel,
        \AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterfaceFactory $searchQuerySearchResultsFactory,
        \AlbertMage\Search\Model\ResourceModel\SearchQuery\CollectionFactory $searchQueryCollectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->searchQueryFactory = $searchQueryFactory;
        $this->searchQueryResourceModel = $searchQueryResourceModel;
        $this->searchQuerySearchResultsFactory = $searchQuerySearchResultsFactory;
        $this->searchQueryCollectionFactory = $searchQueryCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(\AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery)
    {
        $this->searchQueryResourceModel->save($searchQuery);
        return $searchQuery;
    }

    /**
     * @inheritDoc
     */
    public function delete(\AlbertMage\Search\Api\Data\SearchQueryInterface $searchQuery)
    {
        $this->searchQueryResourceModel->delete($searchQuery);
        return $searchQuery;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $searchQuery = $this->searchQueryInterfaceFactory->create()->load($id, 'id');
        if (!$searchQuery->getId()) {
            throw new NoSuchEntityException(
                __("The search query that was requested doesn't exist.")
            );
        }
        return $searchQuery;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var Collection $collection */
        $collection = $this->searchQueryCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $items = $collection->getItems();

        /** @var \AlbertMage\Search\Api\Data\SearchQuerySearchResultsInterface $searchResults */
        $searchResults = $this->searchQuerySearchResultsFactory->create();
        $searchResults->setItems($items);
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
