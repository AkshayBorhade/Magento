<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Allure\Affiliate\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Allure\Affiliate\Helper\Data as AffiliateHelper;
use Allure\Affiliate\Helper\Payment;
use Allure\Affiliate\Model\CampaignFactory;
use Allure\Affiliate\Model\TransactionFactory;
use Magento\Framework\ObjectManagerInterface;
use Allure\Affiliate\Model\AccountFactory;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Allure\Affiliate\Model\WithdrawFactory;
use Allure\Affiliate\Model\WithdrawhistoryFactory;
use Magento\Directory\Helper\Data as DirectoryHelper;

/**
 * Class AbstractAccount
 * @package Magento\Customer\Controller
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class Account extends \Magento\Framework\View\Element\Template
{

	protected $objectManager;

	/** @var \Magento\Customer\Helper\View */
	protected $_helperView;

	/**
	 * @var \Magento\Customer\Helper\Session\CurrentCustomer
	 */
	protected $customerSession;
	/**
	 * @var \Allure\Affiliate\Helper\Data
	 */
	protected $_affiliateHelper;
	/**
	 * @var \Allure\Affiliate\Helper\Account
	 */
	protected $pricingHelper;

	protected $campaignFactory;

	protected $accountFactory;

	protected $_currentAccount = null;

	protected $transactionFactory;
	protected $withdrawFactory;

	protected $paymentHelper;
	protected $jsonHelper;
	protected $registry;

	/**
	 * Constructor
	 *
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
	 * @param \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory
	 * @param \Magento\Customer\Helper\View $helperView
	 * @param array $data
	 */
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Customer\Helper\View $helperView,
		AffiliateHelper $affiliateHelper,
		Payment $paymentHelper,
		JsonHelper $jsonHelper,
		Registry $registry,
		\Magento\Framework\Pricing\Helper\Data $pricingHelper,
		ObjectManagerInterface $objectManager,
		CampaignFactory $campaignFactory,
		AccountFactory $accountFactory,
		WithdrawFactory $withdrawFactory,
		TransactionFactory $transactionFactory,
		array $data = []
	)
	{
		$this->pricingHelper    = $pricingHelper;
		$this->objectManager    = $objectManager;
		$this->customerSession  = $customerSession;
		$this->_helperView      = $helperView;
		$this->_affiliateHelper = $affiliateHelper;
		$this->paymentHelper    = $paymentHelper;
		$this->jsonHelper       = $jsonHelper;
		$this->registry         = $registry;

		$this->accountFactory     = $accountFactory;
		$this->campaignFactory    = $campaignFactory;
		$this->transactionFactory = $transactionFactory;
		$this->withdrawFactory    = $withdrawFactory;

		parent::__construct($context, $data);
	}

	/**
	 * Returns the Magento Customer Model for this block
	 *
	 * @return \Magento\Customer\Api\Data\CustomerInterface|null
	 */
	public function getCustomer()
	{
		try {
			return $this->customerSession->getCustomer();
		} catch (NoSuchEntityException $e) {
			return null;
		}
	}

	public function getCurrentAccount()
	{
		if (is_null($this->_currentAccount)) {
			$this->_currentAccount = $this->_affiliateHelper->getCurrentAffiliate();
		}

		return $this->_currentAccount;
	}

	/**
	 * Get the full name of a customer
	 *
	 * @return string full name
	 */
	public function getName()
	{
		return $this->_helperView->getCustomerName($this->getCustomer());
	}

	public function getAffiliateConfig($code)
	{
		return $this->helper()->getAffiliateConfig($code);
	}

	public function loadCmsBlock($blockIdentify, $title = false)
	{
		return $this->helper()->loadCmsBlock($blockIdentify, $title);
	}

	public function formatPrice($price)
	{
		return $this->pricingHelper->currency($price);
	}

	public function helper()
	{
		return $this->_affiliateHelper;
	}

	public function getConfig($code)
	{
		return $this->helper()->getAffiliateConfig($code);
	}
}
