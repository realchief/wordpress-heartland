<?php

if (!defined('ABSPATH')) {
    exit();
}

class WC_Gateway_SecureSubmit_GlobalPayments_Void
{
    protected $globalpayments = null;

    public function __construct(&$globalpayments = null)
    {
        $this->globalpayments = $globalpayments;
    }

    public function call($order)
    {
        try {
            if (!$order) {
                throw new Exception(__('Order cannot be found', 'wc_securesubmit'));
            }

            $orderId = WC_SecureSubmit_Util::getData($order, 'get_id', 'id');

            $globalpaymentsOrderId = get_post_meta($orderId, '_globalpayments_order_id', true);
            if (!$globalpaymentsOrderId) {
                throw new Exception(__('GlobalPayments order id cannot be found', 'wc_securesubmit'));
            }

            $globalpaymentsPaymentStatus = get_post_meta($orderId, '_globalpayments_payment_status', true);
            if ($globalpaymentsPaymentStatus !== 'authorized') {
                throw new Exception(__(sprintf('Transaction has already been %s', $globalpaymentsPaymentStatus), 'wc_securesubmit'));
            }

            $service = $this->globalpayments->getService();

            $response = $service->void(
                $globalpaymentsOrderId
            );

            update_post_meta($orderId, '_globalpayments_payment_status', 'voided', 'authorized');

            $order->add_order_note(__('GlobalPayments payment voided', 'wc_securesubmit') . ' (Transaction ID: ' . $response->transactionId . ')');
            return true;
        } catch (Exception $e) {
            $error = __('Error:', 'wc_securesubmit') . ' "' . (string)$e->getMessage() . '"';
            if (function_exists('wc_add_notice')) {
                wc_add_notice($error, 'error');
            } else if (method_exists(WC(), 'add_error')) {
                WC()->add_error($error);
            }
            return false;
        }
    }
}
