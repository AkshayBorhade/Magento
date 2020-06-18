<?php

namespace Allure\Affiliate\Ui\Component\Listing\Column;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * URL builder
     * 
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * constructor
     * 
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $config = $this->getData('config');
            foreach ($dataSource['data']['items'] as & $item) {
                $indexField = $config['indexField'];
                if (isset($item[$indexField])) {
                    foreach($config['action_list'] as $name => $action){
                        $actionArray = [
                            'href' => $this->_urlBuilder->getUrl(
                                $action['url_path'], [$config['paramName'] => $item[$indexField]]
                            ),
                            'label' => __($action['label'])
                        ];
                        if($name == 'delete'){
                            $actionArray['confirm'] = [
                                'title' => __('Delete "%1"', $item[$indexField]),
                                'message' => __('Are you sure?')
                            ];
                        }
                        $item[$this->getData('name')][$name] = $actionArray;
                    }
                }
            }
        }
        return $dataSource;
    }
}
