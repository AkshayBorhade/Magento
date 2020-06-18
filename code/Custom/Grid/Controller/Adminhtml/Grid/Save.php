<?php

namespace Custom\Grid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Katalyst\DesignData\Model\Color;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\RequestInterface;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    protected $scopeConfig;
    protected $_escaper;
    protected $inlineTranslation;
    protected $_dateFactory;

    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
    Context $context, DataPersistorInterface $dataPersistor, \Magento\Framework\Escaper $escaper, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory, \Custom\Grid\Model\Grid $gridFactory
    ) {

        $this->dataPersistor = $dataPersistor;
        $this->scopeConfig = $scopeConfig;
        $this->_escaper = $escaper;
        $this->_dateFactory = $dateFactory;
        $this->inlineTranslation = $inlineTranslation;
        $this->gridFactory = $gridFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();


        if ($data) {
            $employee_id  = $this->getRequest()->getParam('employee_id');

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->gridFactory->load($employee_id);
            if (!$model->getId() && $employee_id) {
                $this->messageManager->addError(__('This employee no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data = array_filter($data, function($value) {
                return $value !== '';
            });


            $model->setData($data);


            $this->inlineTranslation->suspend();
            try {

                $model->save();


                $this->messageManager->addSuccess(__(' Saved successfully'));
                $this->dataPersistor->clear('employee_form_data');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the customer.'));
                print_r($e);
            }

            $this->dataPersistor->set('employee_form_data', $data);
        }
        return $resultRedirect->setPath('*/*');
    }

}
