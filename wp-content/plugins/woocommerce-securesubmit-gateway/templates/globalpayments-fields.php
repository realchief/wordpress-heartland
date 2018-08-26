<?php
if (!defined('ABSPATH')) {
    exit();
}
?>

<div class="globalpayments-checkout">
  <input type="hidden"
         name="action"
         value="securesubmit_globalpayments_lookup" />

  <?php if (!empty($cards)): ?>
    <h6>Credit Cards</h6>
    <?php foreach ($cards as $card): ?>
      <label>
        <input type="radio"
               name="masterpass_card_id"
               value="<?= $card->CardId; ?>"
               <?php if ($card->SelectedAsDefault == 'true'): ?> checked="checked"<?php endif;?> />
        <?= $card->BrandName; ?>
        ending in <?= $card->LastFour; ?>
        expiring <?= $card->ExpiryMonth; ?>/<?= $card->ExpiryYear; ?>
        <?php if ($card->SelectedAsDefault == 'true'): ?>(default)<?php endif; ?>
      </label><br />
    <?php endforeach; ?>
  <?php endif; ?>

  <button type="button" class="button" id="securesubmit-buy-with-globalpayments">
    <span class="globalpayments-logo">
      <img src="https://www.mastercard.com/mc_us/wallet/img/en/US/mcpp_wllt_btn_chk_147x034px.png"
           alt="<?= __('Buy with Globalpayments'); ?>" />
    </span>
    <span class="sr-only"><?= __('Buy with Globalpayments'); ?></span>
  </button>

  <a href="http://www.mastercard.com/mc_us/wallet/learnmore/en"
     class="globalpayments-learn-more"
     target="_blank"
     title="<?= __('Learn more about Globalpayments', 'wc_securesubmit'); ?>">
    <?= __('Learn more', 'wc_securesubmit'); ?>
  </a>

  <script data-cfasync="false" type="text/javascript">
    window.securesubmitGlobalpaymentsLookup = window.securesubmitGlobalpaymentsLookup || function () {};
    window.securesubmitGlobalpaymentsLookup();
  </script>
</div>
