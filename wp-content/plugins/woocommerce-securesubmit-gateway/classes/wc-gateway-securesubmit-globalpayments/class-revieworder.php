<?php

if (!defined('ABSPATH')) {
    exit();
}

class WC_Gateway_SecureSubmit_GlobalPayments_ReviewOrder
{
    protected $globalpayments = null;
    protected $transactionsAllowed  = null;

    public function __construct(&$globalpayments = null)
    {
        $this->globalpayments = $globalpayments;
    }

    public function processCheckout()
    {
      $action = (isset($_POST['mp_action']) ? $_POST['mp_action'] : (isset($_GET['mp_action']) ? $_GET['mp_action'] : null));
      if ($action && 'process_payment' === $action) {
        $_POST = array_merge($_POST, maybe_unserialize(WC()->session->checkout_form));
        // force payment method to MasterPass since hitting MasterPass review order page
        $_POST['payment_method'] = $this->globalpayments->id;
        WC()->checkout->process_checkout();
      }
    }

    /**
     * Callback for `woocommerce_review_order` shortcode. Called from
     * `WC_Shortcodes::shortcode_wrapper`.
     */
    public function call()
    {
        $action = (isset($_POST['mp_action']) ? $_POST['mp_action'] : (isset($_GET['mp_action']) ? $_GET['mp_action'] : null));
        if ($action && 'review_order' === $action) {
            $this->authenticateAndDisplayReviewOrder();
        }

        if ($action && 'process_payment' === $action) {
            // if this point is reached, error
            // headers already sent at this point. redirect with js
            echo '<script data-cfasync="false" type="text/javascript">window.location.href = \'' . WC()->cart->get_checkout_url() . '\';</script>';
            wp_die();
        }
    }

    /**
     * Authenticates a return request from MasterPass
     *
     * On success, data is cached in session storage to properly handle consumer
     * browser refreshes, and the consumer is presented with the order review
     * page. On cancel or failure, consumer is redirected back to the checkout
     * page.
     */
    public function authenticateAndDisplayReviewOrder()
    {
        $status = isset($_GET['mpstatus']) ? $_GET['mpstatus'] : '';

        if ('success' !== $status) {
            $error = __('Error:', 'wc_securesubmit') . ' Invalid MasterPass session';
            if (function_exists('wc_add_notice')) {
                wc_add_notice($error, 'error');
            } else {
                WC()->add_error($error);
            }
            // headers already sent at this point. redirect with js
            echo '<script data-cfasync="false" type="text/javascript">window.location.href = \'' . WC()->cart->get_checkout_url() . '\';</script>';
            wp_die();
        }

        $payload = get_transient('_globalpayments_payload');
        $orderId = get_transient('_globalpayments_order_id');
        $orderNumber = get_transient('_globalpayments_order_number');

        $checkoutResourceUrl = isset($_GET['checkout_resource_url']) ? urldecode($_GET['checkout_resource_url']) : '';
        $oauthVerifier = isset($_GET['oauth_verifier']) ? $_GET['oauth_verifier'] : '';
        $oauthToken = isset($_GET['oauth_token']) ? $_GET['oauth_token'] : '';
        $pairingVerifier = isset($_GET['pairing_verifier']) ? $_GET['pairing_verifier'] : '';
        $pairingToken = isset($_GET['pairing_token']) ? $_GET['pairing_token'] : '';
        $data = null;

        try {
            $service = $this->globalpayments->getService();
            $orderData = new HpsOrderData();
            $orderData->transactionStatus = $status;
            if ($pairingToken !== '' && $pairingVerifier !== '') {
                $orderData->pairingToken = $pairingToken;
                $orderData->pairingVerifier = $pairingVerifier;
                $orderData->checkoutType = HpsCentinelCheckoutType::PAIRING_CHECKOUT;
            }

            // Authenticate the request with the information we've gathered
            $response = $service->authenticate(
                $orderId,
                $oauthToken,
                $oauthVerifier,
                $payload,
                $checkoutResourceUrl,
                $orderData
            );

            if ('0' !== $response->errorNumber) {
                throw new Exception();
            }

            $data = (object)array_merge((array)$response, array(
                'status' => $status,
            ));
            WC()->session->set('globalpayments_authenticate', $data);
        } catch (Exception $e) {
            $data = WC()->session->get('globalpayments_authenticate');
        }

        $pluginPath = plugin_dir_path(dirname(dirname(__FILE__))) . 'templates/';
        wc_get_template('globalpayments-review-order.php', array('payload' => $data, 'globalpayments' => $this->globalpayments), '', $pluginPath);
    }
}
