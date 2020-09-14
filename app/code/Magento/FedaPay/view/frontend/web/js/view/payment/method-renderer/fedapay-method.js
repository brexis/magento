/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/* @api */
define([
    'jquery',
    'underscore',
    'Magento_Checkout/js/view/payment/default',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/full-screen-loader',
    'Magento_Checkout/js/action/create-billing-address',
    'Magento_Checkout/js/action/select-billing-address'
    ],
    function (
        $,
        _,
        Component,
        quote,
        fullScreenLoader,
        createBillingAddress,
        selectBillingAddress
        ) {
        'use strict';
        
        return Component.extend({
            defaults: {
                template: 'Magento_FedaPay/payment/fedapay-gateway',
                code: 'fedapay',
            },
            
         /**
         * Get payment name
         *
         * @returns {String}
         */
        getCode: function () {
            return this.code;
        },   
        
        /**
         * Get payment title
         *
         * @returns {String}
         */
        getTitle: function () {
            return window.checkoutConfig.payment[this.getCode()].title;
        },
        
         /**
         * Check if payment is active
         *
         * @returns {Boolean}
         */
        isActive: function () {
            var active = this.getCode() === this.isChecked();

            this.active(active);

            return active;
        },
        
        /**
         * Update quote billing address
         * @param {Object}customer
         * @param {Object}address
         */
        setBillingAddress: function (customer, address) {
            var billingAddress = {
                street: [address.line1],
                city: address.city,
                postcode: address.postalCode,
                countryId: address.countryCode,
                email: customer.email,
                firstname: customer.firstName,
                lastname: customer.lastName,
                telephone: typeof customer.phone !== 'undefined' ? customer.phone : '00000000000'
            };

            billingAddress['region_code'] = typeof address.state === 'string' ? address.state : '';
            billingAddress = createBillingAddress(billingAddress);
            quote.billingAddress(billingAddress);
        },
        
        /**
         * Get shipping address
         * @returns {Object}
         */
        getShippingAddress: function () {
            var address = quote.shippingAddress();

            return {
                recipientName: address.firstname + ' ' + address.lastname,
                line1: address.street[0],
                line2: typeof address.street[2] === 'undefined' ? address.street[1] : address.street[1] + ' ' + address.street[2],
                city: address.city,
                countryCode: address.countryId,
                postalCode: address.postcode,
                state: address.region
            };
        },

        
       /**
         * Returns payment method instructions.
         *
         * @return {*}
         */
             getInstructions: function () {
            return window.checkoutConfig.payment.instructions[this.item.method];
        }
        });
    }
);