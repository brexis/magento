<?php

namespace Magento\FedaPay\Model\Adminhtml\Source;

use Magento\Framework\Option\ArrayInterface;

class PaymentAction implements ArrayInterface
{
    const AUTHORIZE = 'authorize';
    const AUTHORIZE_AND_CAPTURE = 'authorize_capture';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            ['value' => static::AUTHORIZE, 'label' => __('Charge on Shipment')],
            ['value' => static::AUTHORIZE_AND_CAPTURE, 'label' => __('Charge on Order')],
        ];
    }
}
