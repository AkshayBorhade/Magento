<?php

namespace GiftRule\RuleList\Model\ResourceModel\Items;

use \GiftRule\RuleList\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('GiftRule\RuleList\Model\Items', 'GiftRule\RuleList\Model\ResourceModel\Items');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
