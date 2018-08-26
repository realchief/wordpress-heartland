<?php
if (!defined('ABSPATH')) {
    exit();
}
?>

<?php $globalpayments = WC_Gateway_SecureSubmit_GlobalPayments::instance(); ?>
<div class="securesubmit-connect-with-globalpayments">
  <h2><?= __('GlobalPayments', 'wc_securesubmit'); ?></h2>

  <?php $longAccessToken = get_user_meta(get_current_user_id(), '_globalpayments_long_access_token', true); ?>
  <?php if ($longAccessToken): ?>
    <form method="POST">
        <?php wp_nonce_field('globalpayments_remove_long_access_token'); ?>
        <input type="hidden" name="forget_globalpayments" value="true">
        <input type="submit" value="Disconnect">
    </form>
  <?php else: ?>
    <button type="button"
            class="button"
            onclick="jQuery(this).attr('disabled', 'disabled').val('Processing'); jQuery(this).parents('form').submit(); return false;"
            id="securesubmit-connect-with-globalpayments">
      <img src="https://www.mastercard.com/mc_us/wallet/img/en/US/mp_connect_with_button_034px.png"
             alt="Connect with GlobalPayments" />
    </button>

    <script data-cfasync="false" type="text/javascript">var wc_securesubmit_globalpayments_params = {ajaxUrl: '<?= admin_url('admin-ajax.php'); ?>'};</script>
    <?php if ('production' === $globalpayments->environment): ?>
        <script data-cfasync="false" type="text/javascript" src="https://api2-c.heartlandportico.com/SecureSubmit.v1/token/gp-1.0.2/globalpayments.js"></script>
    <?php else: ?>
        <script data-cfasync="false" type="text/javascript" src="https://api2-c.heartlandportico.com/SecureSubmit.v1/token/gp-1.0.2/globalpayments.js"></script>
    <?php endif;?>
    <script data-cfasync="false" type="text/javascript" src="<?= plugins_url('assets/js/masterpass.js', dirname(__FILE__)); ?>"></script>
  <?php endif; ?>
</div>
