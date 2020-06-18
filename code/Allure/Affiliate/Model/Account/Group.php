<?php
 
namespace Allure\Affiliate\Model\Account;

/**
 * Class Group
 * @package Allure\Affiliate\Model\Account
 */
class Group implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @type \Allure\Affiliate\Model\GroupFactory
     */
    protected $group;

    public function __construct(
        \Allure\Affiliate\Model\GroupFactory $groupFactory
    )
    {
        $this->group = $groupFactory;
    }


    /**
     * to option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $group   = $this->getGroupCollection();
        $options = array();
        foreach ($group as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName()
            ];
        }

        return $options;
    }

    public function getOptionHash(){
        foreach($this->getGroupCollection() as $group){

        }
    }

    public function getGroupCollection()
    {
        $groupModel = $this->group->create();

        return $groupModel->getCollection();
    }
}
