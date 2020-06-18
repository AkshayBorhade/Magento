<?php

namespace Allure\Affiliate\Observer;

use Magento\Framework\Event\ObserverInterface;
use Allure\Affiliate\Model\AccountFactory;
use Allure\Affiliate\Helper\Data;
use Allure\Affiliate\Model\Config\Source\Urlparam;
use Magento\Store\Model\StoreManagerInterface;

class PredispatchObserver implements ObserverInterface
{
	protected $_accountFactory;

	protected $_helper;

	protected $urlParam;

	protected $storeManager;

	public function __construct(
		AccountFactory $accountFactory,
		Data $helper,
		Urlparam $urlParam,
		StoreManagerInterface $storeManager
	)
	{
		$this->_accountFactory = $accountFactory;
		$this->_helper         = $helper;
		$this->urlParam        = $urlParam;
		$this->storeManager        = $storeManager;
	}

	/**
	 * Check Captcha On User Login Page
	 *
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return $this
	 */
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$urlPrefix = $this->_helper->getAffiliateConfig('general/url/prefix');
		$key       = $observer->getRequest()->getParam($urlPrefix);
		if ($key) {
			$account   = $this->_accountFactory->create();
			$urlParams = $this->urlParam->getOptionHash();
			foreach ($urlParams as $code => $label) {
				$account->load($key, $code);
				if ($account->getId()) {
					if ($account->isActive()) {
						$isSetCookie = false;
						if ($this->_helper->getAffiliateKeyFromCookie()) {
							if ($this->_helper->getAffiliateConfig('general/overwrite_cookies')) {
								$isSetCookie = true;
							}
						} else {
							$isSetCookie = true;
						}

						if ($isSetCookie)
							$this->setAffiliateKeyToCookie($observer->getRequest(), $account->getCode());
							$redirectUrl = $this->storeManager->getStore()->getBaseUrl();
							$url = $this->_helper->getAffiliateConfig('refer/default_link');
							if ($url) {
								$redirectUrl = $url;
							}
							$observer->getControllerAction()->getResponse()->setRedirect($redirectUrl);
					}
					break;
				}
			}
		}

		return $this;
	}

	public function setAffiliateKeyToCookie($request, $code)
	{
		$this->_helper->setAffiliateKeyToCookie($code);

		if ($source = $request->getParam('source')) {
			$this->_helper->setAffiliateKeyToCookie($source, \Allure\Affiliate\Helper\Data::AFFILIATE_COOKIE_SOURCE_NAME);
			if ($key = $request->getParam('key')) {
				$this->_helper->setAffiliateKeyToCookie($key, \Allure\Affiliate\Helper\Data::AFFILIATE_COOKIE_SOURCE_VALUE);
			}
		}
	}
}
