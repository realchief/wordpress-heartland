<?php

if (!defined('ABSPATH')) {
    exit();
}

class WC_Gateway_SecureSubmit_GlobalPayments_Payment
{
    protected $globalpayments = null;

    public function __construct(&$globalpayments = null)
    {
        $this->globalpayments = $globalpayments;
    }

    public function call($orderId)
    {
        $order = wc_get_order($orderId);
        $cart = WC()->cart;
        $checkoutForm = maybe_unserialize(WC()->session->checkout_form);

        try {
            $authenticate = WC()->session->get('globalpayments_authenticate');
            if (!$authenticate) {
                throw new Exception(__('Error:', 'wc_securesubmit') . ' Invalid MasterPass session');
            }

            $service = $this->globalpayments->getService();

            // Create an authorization
            $response = null;
            if ('sale' === $this->globalpayments->paymentAction) {
                $response = $service->sale(
                    $authenticate->orderId,
                    $cart->total,
                    strtolower(get_woocommerce_currency()),
                    $this->globalpayments->getBuyerData($checkoutForm),
                    $this->globalpayments->getPaymentData($cart),
                    $this->globalpayments->getShippingInfo($checkoutForm),
                    $this->globalpayments->getLineItems($cart)
                );
            } else {
                $response = $service->authorize(
                    $authenticate->orderId,
                    $cart->total,
                    strtolower(get_woocommerce_currency()),
                    $this->globalpayments->getBuyerData($checkoutForm),
                    $this->globalpayments->getPaymentData($cart),
                    $this->globalpayments->getShippingInfo($checkoutForm),
                    $this->globalpayments->getLineItems($cart)
                );
            }

            $transactionId = null;
            if (property_exists($response, 'capture')) {
                $transactionId = $response->capture->transactionId;
            } else {
                $transactionId = $response->transactionId;
            }

            $order->add_order_note(__('GlobalPayments payment completed', 'wc_securesubmit') . ' (Transaction ID: ' . $transactionId . ')');
            $order->payment_complete($transactionId);
            $cart->empty_cart();

            $orderId = WC_SecureSubmit_Util::getData($order, 'get_id', 'id');

            update_post_meta($orderId, '_transaction_id', $transactionId);
            update_post_meta($orderId, '_globalpayments_order_id', $authenticate->orderId);
            update_post_meta($orderId, '_globalpayments_payment_status', 'sale' === $this->globalpayments->paymentAction ? 'captured' : 'authorized');

            return array(
                'result'   => 'success',
                'redirect' => $this->globalpayments->get_return_url($order),
            );
        } catch (Exception $e) {
            $error = __('Error:', 'wc_securesubmit') . ' "' . (string)$e->getMessage() . '"';
            if (function_exists('wc_add_notice')) {
                wc_add_notice($error, 'error');
            } else if (method_exists(WC(), 'add_error')) {
                WC()->add_error($error);
            }

            return array(
                'result'   => 'fail',
                'redirect' => $cart->get_checkout_url(),
            );
        }
    }
}
