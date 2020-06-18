<?php

namespace Custom\Grid\Block\Adminhtml\Employee\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var BlockRepositoryInterface
     */
    protected $GridFactory;

    /**
     * @param Context $context
     * @param BlockRepositoryInterface $ColorCategoryFactory
     */
    public function __construct(
        Context $context,
        \Custom\Grid\Model\GridFactory $GridFactory
    ) {
        $this->context = $context;
        $this->gridFactory = $GridFactory;
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getModelById()
    {
        try {
            return $this->gridFactory->create()->load(
                $this->context->getRequest()->getParam('employee_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * Check where button can be rendered
     *
     * @param string $name
     * @return string
     */
    public function canRender($name)
    {
        return $name;
    }
}
