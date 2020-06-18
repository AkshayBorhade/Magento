<?php

namespace Allure\Affiliate\Model\ResourceModel;

/**
 * Class Account
 * @package Allure\Affiliate\Model\ResourceModel
 */
class Account extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * @type \Allure\Affiliate\Helper\Data
	 */
	protected $_helper;

	/**
	 * @param \Allure\Affiliate\Helper\Data $helper
	 * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
	 */
	public function __construct(
		\Allure\Affiliate\Helper\Data $helper,
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		$this->_helper = $helper;
		parent::__construct($context);
	}


	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('allure_affiliate_account', 'account_id');
	}

	/**
	 * before save callback
	 *
	 * @param \Magento\Framework\Model\AbstractModel|\Allure\Affiliate\Model\Account $object
	 * @return $this
	 */
	protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
	{
		$object->setUpdatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
		if ($object->isObjectNew()) {
			$object->setCreatedAt((new \DateTime())->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT));
			if (!$object->hasData('group_id')) {
				$object->setGroupId($this->_helper->getAffiliateConfig('account/sign_up/default_group'));
			}
		}
		if (!$object->hasData('status')) {
			$status = $this->_helper->getAffiliateConfig('account/sign_up/admin_approved')
				? \Allure\Affiliate\Model\Account\Status::NEED_APPROVED
				: \Allure\Affiliate\Model\Account\Status::ACTIVE;
			$object->setStatus($status);
		}
		if (!$object->hasData('code')) {
			$object->setCode($this->generateAffiliateCode());
		}

		return parent::_beforeSave($object);
	}

	/**
	 * @param \Magento\Framework\Model\AbstractModel $object
	 * @return $this
	 */
	protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
	{
		parent::_afterSave($object);
		if ($object->isObjectNew()) {
			$account = $this->_helper->getAffiliateAccount($object->getId());
			if ($parentId = $object->getParent()) {
				$parent = $this->_helper->getAffiliateAccount($parentId);
				if ($parent && $parent->getId()) {
					$account->setTree($parent->getTree() . '/' . $account->getId())
						->save();
				}
			} else {
				$account->setTree($account->getId())
					->save();
			}
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function generateAffiliateCode()
	{
		$flag = true;
		do {
			$code    = substr(str_shuffle(md5(microtime())), 0, $this->getCodeLength());
			$account = $this->_helper->getAffiliateAccount($code, 'code');
			if (!$account->getId()) {
				$flag = false;
			}
		} while ($flag);

		return $code;
	}

	/**
	 * @return int|mixed
	 */
	public function getCodeLength()
	{
		$length = $this->_helper->getAffiliateConfig('general/url/code_length');
		if (is_nan($length) || $length <= 0) {
			$length = 6;
		}
		if ($length > 32) {
			$length = 32;
		}

		return $length;
	}
}
