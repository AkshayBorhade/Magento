<?php

////////////////////////////////////////////
// Created By : Akshay Jadhav
// IP : Order object 
// Purpose : To generate auto coupon code & save to customtable .
////////////////////////////////////////////

namespace Gift\Coupon\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Gift\Coupon\Model\GiftFactory;

class SaveDataToOrderObserver implements ObserverInterface {

    protected $_context;
    protected $_transportBuilder;
    protected $_messageManager;

    public function __construct(
            GiftFactory $modelGiftFactory,
            \Magento\Framework\Math\Random $mathRandom,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            \Magento\Framework\Message\ManagerInterface $messageManager,
            \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    ) {
        $this->_storeManager = $storeManager;
        $this->_modelGiftFactory = $modelGiftFactory;
        $this->mathRandom = $mathRandom;
        $this->_transportBuilder = $transportBuilder;
        $this->_messageManager = $messageManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {

        $order = $observer->getEvent()->getOrder();
        $order_number = $order->getIncrementId();
        $customerId = $order->getCustomerId();
        $customerEmail = $order->getCustomerEmail();
        $customerName = '';


        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customer = $objectManager->create('Magento\Customer\Model\Customer')->load($customerId);
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');

        if ($customerSession->isLoggedIn()) {
            $customerName = $customerSession->getCustomer()->getName();
        }


        $pcnt = 0;
        $couponMsg = "";

        $sFlag = true;

        foreach ($order->getAllVisibleItems() as $itm) {

            if ($itm->getProductType() == 'gift_card_product') {
                $pcnt++;
            }
        }

        foreach ($order->getAllVisibleItems() as $item) {

            if ($item->getProductType() == 'gift_card_product') {

                $store = $this->_storeManager->getStore()->getId();

                $discountPrice = $item->getProduct()->getResource()->getAttribute('gift_price')->getFrontend()->getValue($item->getProduct());

                try {

                    $chars = \Magento\Framework\Math\Random::CHARS_LOWERS
                            . \Magento\Framework\Math\Random::CHARS_UPPERS
                            . \Magento\Framework\Math\Random::CHARS_DIGITS;
                    $cpcode = $this->mathRandom->getRandomString(6, $chars);


                    $objectManager1 = \Magento\Framework\App\ObjectManager::getInstance();
                    $state = $objectManager1->get('Magento\Framework\App\State');
                    $currencysymbol = $objectManager->get('Magento\Directory\Model\Currency');


                    $coupon = array();
                    $coupon['name'] = 'Gift Rule';
                    $coupon['desc'] = 'Discount for gift coupon.';
                    $coupon['start'] = date('Y-m-d');
                    $coupon['end'] = '';
                    $coupon['max_redemptions'] = 1;
                    $coupon['discount_type'] = 'cart_fixed';
                    $coupon['discount_amount'] = $discountPrice;
                    $coupon['flag_is_free_shipping'] = 'no';
                    $coupon['redemptions'] = 0;
                    $coupon['code'] = strtoupper($cpcode);

                    $couponMsg = $coupon['code'] . " of " . $discountPrice ."".$currencysymbol->getCurrencySymbol()." , " . $couponMsg;

                    $shoppingCartPriceRule = $objectManager1->create('Magento\SalesRule\Model\Rule');
                    $shoppingCartPriceRule->setName($coupon['name'])
                            ->setDescription($coupon['desc'])
                            ->setFromDate($coupon['start'])
                            ->setToDate($coupon['end'])
                            ->setUsesPerCustomer($coupon['max_redemptions'])
                            ->setCustomerGroupIds(array('0', '1', '2', '3',))
                            ->setIsActive(1)
                            ->setSimpleAction($coupon['discount_type'])
                            ->setDiscountAmount($coupon['discount_amount'])
                            ->setApplyToShipping($coupon['flag_is_free_shipping'])
                            ->setTimesUsed($coupon['redemptions'])
                            ->setWebsiteIds(array('1'))
                            ->setCouponType(2)
                            ->setCouponCode($coupon['code'])
                            ->setGiftCardRule('1')
                            ->setUsesPerCoupon(NULL);
                    $shoppingCartPriceRule->save();

                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $model = $this->_modelGiftFactory->create();
                    $model->setTitle("Gift Card");
                    $model->setCode($cpcode);
                    $model->setProductId($item->getProductId());
                    $model->setOrderId($order_number);
                    $model->setCustomerId($customerId);
                    $model->setCreatedAt(date("Y-m-d h:i:sa"));
                    $model->setExpDate(date("Y-m-d h:i:sa", strtotime("+30 days")));
                    $model->setStatus("0");
                    $model->save();
                } catch (\Exception $e) {
                    $sFlag = false;
                }
            }
        }

        if ($pcnt > 0 && $sFlag) {

            $couponMsg = substr($couponMsg, 0, -2);

            if ($pcnt > 1) {
                $msg = 'Your coupon codes are : ';
            } else {
                $msg = 'Your coupon code is : ';
            }

            try {


                $transport = $this->_transportBuilder->setTemplateIdentifier('mymodule_email_template')
                        ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                        ->setTemplateVars(
                                [
                                    'store' => $this->_storeManager->getStore(),
                                    'massege' => $msg . " " . $couponMsg,
                                    'custname' => $customerName,
                                    'link'=>$this->_storeManager->getStore()->getBaseUrl()
                                ]
                        )
                        ->setFrom([
                            'name' => 'Akshay',
                            'email' => 'akshayjadhavp28@gmail.com',
                        ])
                        ->addTo($customerEmail, 'Customer')
                        ->getTransport();

                $transport->sendMessage();

                $this->_messageManager->addSuccess(__('Coupon has been sent on your mail id !'));
            } catch (\Exception $ex) {
                
            }
        }
    }

}
