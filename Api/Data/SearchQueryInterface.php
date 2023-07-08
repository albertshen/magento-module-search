<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Search\Api\Data;

/**
 * SearchQuery Interface
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface SearchQueryInterface
{

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'entity_id';

    const QUERY_TEXT = 'query_text';

    const STORE_ID = 'store_id';

    const CUSTOMER_ID = 'customer_id';

    const GUEST_ID = 'guest_id';

    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get query text
     *
     * @return string
     */
    public function getQueryText();

    /**
     * Set query text
     *
     * @param string $queryText
     * @return $this
     */
    public function setQueryText($queryText);

    /**
     * Get storeId
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set storeId
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Get customerId
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customerId
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Get guestId
     *
     * @return int
     */
    public function getGuestId();

    /**
     * Set guestId
     *
     * @param int $guestId
     * @return $this
     */
    public function setGuestId($guestId);

}