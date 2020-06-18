<?php

namespace Allure\Affiliate\Model;

class Banner extends \Magento\Framework\Model\AbstractModel
{
	/**
	 * Cache tag
	 *
	 * @var string
	 */
	const CACHE_TAG = 'allure_affiliate_banner';

	/**
	 * Cache tag
	 *
	 * @var string
	 */
	protected $_cacheTag = 'allure_affiliate_banner';

	/**
	 * Event prefix
	 *
	 * @var string
	 */
	protected $_eventPrefix = 'allure_affiliate_banner';

	protected $filterProvider;

	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\Registry $registry,
		\Magento\Cms\Model\Template\FilterProvider $filterProvider,
		\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
		\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
		array $data = []
	)
	{
		$this->filterProvider = $filterProvider;
		parent::__construct($context, $registry, $resource, $resourceCollection, $data);
	}

	/**
	 * Initialize resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Allure\Affiliate\Model\ResourceModel\Banner');
	}

	/**
	 * Get identities
	 *
	 * @return array
	 */
	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getContentHtml()
	{
		return $this->filterProvider->getPageFilter()->filter($this->getContent());
	}
}
