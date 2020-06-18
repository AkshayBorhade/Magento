<?php  
namespace Coupon\Newsletter\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\App\Request\DataPersistorInterface;

class Discount implements \Magento\Framework\Event\ObserverInterface {
     protected $ruleFactory;
    protected $massgenerator;
    protected $logger;

    public function __construct( \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation, \Magento\Framework\Escaper $escaper,\Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\SalesRule\Model\RuleFactory $ruleFactory,\Magento\SalesRule\Model\Coupon\Massgenerator $massgenerator, \Psr\Log\LoggerInterface $logger ,\Magento\SalesRule\Model\Coupon\Codegenerator $couponGenerator ,\Magento\SalesRule\Helper\Coupon $couponHelper,\Magento\SalesRule\Model\Coupon $coupon) {
        $this->messageManager = $messageManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->storeManager = $storeManager;
        $this->ruleFactory= $ruleFactory;
        $this->massgenerator = $massgenerator;
        $this->logger = $logger;
        $this->couponGenerator = $couponGenerator;
        $this->couponHelper = $couponHelper;
        $this->coupon = $coupon;
       
        
    }
      
    public function execute(\Magento\Framework\Event\Observer $observer){
        $objectManager = \Magento\Framework\App\objectManager::getInstance();
       /* $rule_id = 1;
        $rule=$objectManager->create('Magento\SalesRule\Model\Rule')->load($rule_id); 
        $rule->setCouponCode($code);
        $rule->save();*/

        $ruleId = 6;
           $couponCodeData = $this->ruleFactory->create()->load($ruleId);

        $salesRule = $objectManager->get(\Magento\SalesRule\Model\Rule::class);


        $code  = $salesRule->getCouponCodeGenerator()->setLength(4)->setAlphabet(
                       'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
                   )->generateCode().'SUBNEW';
        $expirationDate = strtotime("+30 day");   
        $this->couponGenerator->setFormat($this->couponHelper::COUPON_FORMAT_ALPHANUMERIC);   

                
        $this->coupon->setId(null)
        ->setRuleId($ruleId)
        ->setUsageLimit(1000)
        ->setUsagePerCustomer(10000)
        ->setExpirationDate($expirationDate)
        ->setType(1)
        ->setCode($code)
        ->save();


        $this->inlineTranslation->suspend();
        $sender = [
            'name' => "Shivani",
            'email' => 'code@allureinc.co',
            ];
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $transport = $this->transportBuilder
            ->setTemplateIdentifier('newsletter_subscription_custom_email_template')
            ->setTemplateOptions(
             [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
             ])
            ->setTemplateVars(['code' => $code])
            ->setFrom($sender)
            ->addTo($observer->getEvent()->getSubscriber()->getEmail(), 'User')
            ->getTransport();
        $transport->sendMessage();

    }
}