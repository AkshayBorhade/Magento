<?php
 
namespace Allure\Affiliate\Model\ResourceModel;

class Withdraw extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('allure_affiliate_withdraw', 'withdraw_id');
	}

	/**
	 * before save callback
	 *
	 * @param \Magento\Framework\Model\AbstractModel|\Allure\Affiliate\Model\Withdraw $object
	 * @return $this
	 */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		if ($object->isObjectNew()) {
			$object->setCreatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		}

		if ($object->dataHasChangedFor('status') && $object->getStatus() == \Allure\Affiliate\Model\Withdraw\Status::COMPLETE) {
			$object->setResolvedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		}

		return parent::_beforeSave($object);
	}
}
