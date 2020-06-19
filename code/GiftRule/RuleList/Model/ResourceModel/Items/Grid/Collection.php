<?php

namespace GiftRule\RuleList\Model\ResourceModel\Items\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Search\AggregationInterface;
use GiftRule\RuleList\Model\ResourceModel\Items\Collection as QuoteCollection;

/**
 * Class Collection
 * Collection for displaying grid of sales documents
 */
class Collection extends QuoteCollection implements SearchResultInterface {

    /**
     * @var AggregationInterface
     */
    protected $aggregations;
    protected $request;

    public function __construct(
    \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
    \Psr\Log\LoggerInterface $logger,
    \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, 
    \Magento\Framework\Event\ManagerInterface $eitemsManager, 
    \Magento\Framework\App\Request\Http $request, 
    $mainTable, 
    $eitemsPrefix, 
    $eitemsObject, 
    $resourceModel, 
    $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
    $connection = null,
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {


        parent::__construct(
                $entityFactory, $logger, $fetchStrategy, $eitemsManager, $connection, $resource
        );
        $this->_eitemsPrefix = $eitemsPrefix;
        $this->_eitemsObject = $eitemsObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
        $this->request = $request;
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations() {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations) {
        $this->aggregations = $aggregations;
    }

    /**
     * Retrieve all ids for collection
     * Backward compatibility with EAV collection
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAllIds($limit = null, $offset = null) {
        return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria() {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null) {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount() {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount) {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null) {
        return $this;
    }

    protected function _initSelect() {

        $con = '';

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('Magento\Framework\App\Request\Http');
        $search = $request->getParam('search');

        if ($search!='') {
            $con = " AND sr.name LIKE '%" . $search . "%' OR sc.code LIKE '%" . $search . "%' ";
        }

        parent::_initSelect();

        $this->getSelect()->joinLeft(
                ['sc' => $this->getTable('salesrule_coupon')], 'main_table.code = sc.code', ['*']
        );

        $this->getSelect()->joinLeft(
                ['sr' => $this->getTable('salesrule')], 'sc.rule_id = sr.rule_id', ['*']
        );

        $this->getSelect()->joinLeft(
                ['cs' => $this->getTable('customer_entity')], 'main_table.customer_id = cs.entity_id', ['*']
        );

        $this->getSelect()->where("sr.gift_card_rule='1' " . $con);


        return $this;
    }

}
