<?php
/**
 * FedaPay payment method model
 *
 * @category    FedaPay
 * @package     Magento_FedaPay
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\FedaPay\Model;

// require_once(__DIR__ .'FedaPay/Magento_Gateway/fedapay-php/init.php');
// require_once('');

class FedaPay extends \Magento\Payment\Model\Method\AbstractMethod
{
    
    const PAYMENT_METHOD_FEDAPAY_CODE = 'fedapay';
    
     /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_FEDAPAY_CODE;
    
    /**
     * Cash On Delivery payment block paths
     *
     * @var string
     */
    protected $_formBlockType = \Magento\FedaPay\Block\Form\FedaPay::class;

    /**
     * Info instructions block path
     *
     * @var string
     */
    protected $_infoBlockType = \Magento\FedaPay\Block\Info\FedaPay::class;


    protected $_isGateway                   = true;
    protected $_canCapture                  = true;
    protected $_canCapturePartial           = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = true;


    protected $_minAmount = null;
    protected $_maxAmount = null;
    protected $_supportedCurrencyCodes = array('XOF');

    protected $_debugReplacePrivateDataKeys = ['number', 'exp_month', 'exp_year', 'cvc'];

    // public function __construct(
    //     \Magento\Framework\Model\Context $context,
    //     \Magento\Framework\Registry $registry,
    //     \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
    //     \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
    //     \Magento\Payment\Helper\Data $paymentData,
    //     \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
    //     \Magento\Payment\Model\Method\Logger $logger,
    //     \Magento\Framework\Module\ModuleListInterface $moduleList,
    //     \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,

    //     array $data = array()
    // ) {
    //     parent::__construct(
    //         $context,
    //         $registry,
    //         $extensionFactory,
    //         $customAttributeFactory,
    //         $paymentData,
    //         $scopeConfig,
    //         $logger,
    //         $moduleList,
    //         $localeDate,
    //         null,
    //         null,
    //         $data
    //     );

    //     // $this->_countryFactory = $countryFactory;

    //     // $this->_stripeApi = $stripe;
    //     // $this->_stripeApi->setApiKey(
    //     //     $this->getConfigData('api_key')
    //     // );

    //     // Setup FedaPay SDK
    //     $this->setupFedaPaySdk($this->getConfigData('environment'), $this->getConfigData('test_key'), $this->getConfigData('live_key'));

    //     $this->_minAmount = $this->getConfigData('min_order_total');
    //     $this->_maxAmount = $this->getConfigData('max_order_total');
    // }


    // /**
    //  * Setup FedaPay SDK
    //  */
    // private function setupFedaPaySdk($test_mode, $test_sk, $live_sk)
    // {
    //     if ($test_mode == 'sandbox') {
    //         \FedaPay\FedaPay::setApiKey($test_sk);
    //         \FedaPay\FedaPay::setEnvironment('sandbox');
    //     } else {
    //         \FedaPay\FedaPay::setApiKey($live_sk);
    //         \FedaPay\FedaPay::setEnvironment('live');
    //     }
    // }

     /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }

    // /**
    //  * Availability for currency
    //  *
    //  * @param string $currencyCode
    //  * @return bool
    //  */
    // public function canUseForCurrency($currencyCode)
    // {
    //     if (!in_array($currencyCode, $this->_supportedCurrencyCodes)) {
    //         return false;
    //     }
    //     return true;
    // }
}