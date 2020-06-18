<?php

namespace Allure\Affiliate\Model\ResourceModel;

class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('allure_affiliate_group', 'group_id');
	}

	/**
	 * Retrieves Group Name from DB by passed id.
	 *
	 * @param string $id
	 * @return string|bool
	 */
	public function getGroupNameById($id)
	{
		$adapter = $this->getConnection();
		$select  = $adapter->select()
			->from($this->getMainTable(), 'name')
			->where('group_id = :group_id');
		$binds   = ['group_id' => (int)$id];

		return $adapter->fetchOne($select, $binds);
	}

	/**
	 * before save callback
	 *
	 * @param \Magento\Framework\Model\AbstractModel|\Allure\Affiliate\Model\Group $object
	 * @return $this
	 */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		if ($object->isObjectNew()) {
			$object->setCreatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		}

		return parent::_beforeSave($object);
	}
}
