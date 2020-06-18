<?php
 
namespace Allure\Affiliate\Model\ResourceModel;

use Magento\Framework\Stdlib\DateTime;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('allure_affiliate_banner', 'banner_id');
	}

	/**
	 * before save callback
	 *
	 * @param \Magento\Framework\Model\AbstractModel|\Allure\Affiliate\Model\Banner $object
	 * @return $this
	 */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		$object->setUpdatedAt((new \DateTime())->format(DateTime::DATETIME_PHP_FORMAT));
		if ($object->isObjectNew()) {
			$object->setCreatedAt((new \DateTime())->format(DateTime::DATETIME_PHP_FORMAT));
		}

		return parent::_beforeSave($object);
	}
}
