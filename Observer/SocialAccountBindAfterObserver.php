<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
declare(strict_types=1);

namespace AlbertMage\Search\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use AlbertMage\Search\Api\Data\SearchQueryInterfaceFactory;

/**
 * 
 */
class SocialAccountBindAfterObserver implements ObserverInterface
{

    /**
     * @var SearchQueryInterfaceFactory
     */
    protected $searchQueryInterfaceFactory;

    /**
     * @param SearchQueryInterfaceFactory $searchQueryInterfaceFactory
     */
    public function __construct(
        SearchQueryInterfaceFactory $searchQueryInterfaceFactory
    ) {
        $this->searchQueryInterfaceFactory = $searchQueryInterfaceFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        // $socialAccount = $observer->getSocialAccount();

        // $searchQuery = $this->$searchQueryInterfaceFactory->create()->load($socialAccount->getId(), 'guest_id');

        // if ($searchQuery->getId()) {
            
        //     // $searchQuery->setCustomerId($socialAccount->getCustomer()->getId());
            
        //     // $searchQuery->save();
        // }
        
    }
}
