<?php

namespace Allure\Affiliate\Model\ResourceModel;
use Allure\Affiliate\Helper\Data as Helper;

class Campaign extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * Date time handler
	 *
	 * @var \Magento\Framework\Stdlib\DateTime
	 */
	protected $_dateTime;

	/**
	 *
	 * @var \Allure\Affiliate\Helper\Data
	 */
	protected $helper;

	/**
	 * constructor
	 *
	 * @param \Magento\Framework\Stdlib\DateTime $dateTime
	 * @param \Allure\Affiliate\Helper\Data $helper
	 * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
	 */
	public function __construct(
		\Magento\Framework\Stdlib\DateTime $dateTime,
		Helper $helper,
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		$this->_dateTime = $dateTime;
		$this->helper = $helper;
		parent::__construct($context);
	}


	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('allure_affiliate_campaign', 'campaign_id');
	}

	/**
	 * Retrieves Campaign Name from DB by passed id.
	 *
	 * @param string $id
	 * @return string|bool
	 */
	public function getCampaignNameById($id)
	{
		$adapter = $this->getConnection();
		$select  = $adapter->select()
			->from($this->getMainTable(), 'name')
			->where('campaign_id = :campaign_id');
		$binds   = ['campaign_id' => (int)$id];

		return $adapter->fetchOne($select, $binds);
	}

	/**
	 * before save callback
	 *
	 * @param \Magento\Framework\Model\AbstractModel|\Allure\Affiliate\Model\Campaign $object
	 * @return $this
	 */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		if (is_array($object->getWebsiteIds())) {
			$object->setWebsiteIds(implode(',', $object->getWebsiteIds()));
		}

		if (is_array($object->getAffiliateGroupIds())) {
			$object->setWebsiteIds(implode(',', $object->getAffiliateGroupIds()));
		}
		$object->setUpdatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		if ($object->isObjectNew()) {
			$object->setCreatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		}
		if ($object->getCommission() && is_array($object->getCommission())) {
			$object->setCommission($this->helper->serialize($object->getCommission()));
		} else {
			$object->setCommission($this->helper->serialize(array()));
		}

		foreach (['from_date', 'to_date'] as $field) {
			$value = !$object->getData($field) ? null : $object->getData($field);
			$object->setData($field, $this->_dateTime->formatDate($value));
		}

		return parent::_beforeSave($object);
	}

	protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
	{
		parent::_afterLoad($object);
		$object->setCommission($this->helper->unserialize($object->getCommission()));

		return $this;
	}

}
