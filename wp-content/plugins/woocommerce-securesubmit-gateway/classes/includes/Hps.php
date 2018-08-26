<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('PS')) {
    define('PS', PATH_SEPARATOR);
}

if (!defined('HPS_SDK_LOADED')) {
    // Setup
    define('HPS_SDK_LOADED', true);
    $baseDir = dirname(__FILE__).DS.'src/';
    $originalPath = get_include_path();
    ini_set('include_path', $originalPath . PATH_SEPARATOR . $baseDir);

    require_once 'HostedPaymentConfig.php';
    require_once 'ServicesConfig.php';
    require_once 'ServicesContainer.php';

    // Builders
    require_once 'Builders/AuthorizationBuilder.php';
    require_once 'Builders/BaseBuilder.php';
    require_once 'Builders/ManagementBuilder.php';
    require_once 'Builders/RecurringBuilder.php';
    require_once 'Builders/ReportBuilder.php';
    require_once 'Builders/TransactionBuilder.php';
    require_once 'Builders/TransactionReportBuilder.php';
    require_once 'Builders/BaseBuilder/ValidationClause.php';
    require_once 'Builders/BaseBuilder/Validations.php';
    require_once 'Builders/BaseBuilder/ValidationTarget.php';

    // Entities
    require_once 'Entities/Address.php';
    require_once 'Entities/BatchSummary.php';
    require_once 'Entities/Customer.php';
    require_once 'Entities/DccRateData.php';
    require_once 'Entities/DccResponseResult.php';
    require_once 'Entities/EcommerceInfo.php';
    require_once 'Entities/EncryptionData.php';
    require_once 'Entities/Enum.php';
    require_once 'Entities/FraudManagementResponse.php';
    require_once 'Entities/HostedPaymentData.php';
    require_once 'Entities/IRecurringEntity.php';
    require_once 'Entities/RecurringEntity.php';
    require_once 'Entities/Schedule.php';
    require_once 'Entities/Transaction.php';
    require_once 'Entities/TransactionSummary.php';
    require_once 'Entities/Enums/AccountType.php';
    require_once 'Entities/Enums/AddressType.php';
    require_once 'Entities/Enums/AliasAction.php';
    require_once 'Entities/Enums/CheckType.php';
    require_once 'Entities/Enums/CvnPresenceIndicator.php';
    require_once 'Entities/Enums/DccProcessor.php';
    require_once 'Entities/Enums/DccRateType.php';
    require_once 'Entities/Enums/EcommerceChannel.php';
    require_once 'Entities/Enums/EncyptedMobileType.php';
    require_once 'Entities/Enums/EntryMethod.php';
    require_once 'Entities/Enums/ExceptionCodes.php';
    require_once 'Entities/Enums/FraudFilterMode.php';
    require_once 'Entities/Enums/GiftEntryMethod.php';
    require_once 'Entities/Enums/HppVersion.php';
    require_once 'Entities/Enums/InquiryType.php';
    require_once 'Entities/Enums/PaymentMethodType.php';
    require_once 'Entities/Enums/PaymentSchedule.php';
    require_once 'Entities/Enums/ReasonCode.php';
    require_once 'Entities/Enums/RecurringSequence.php';
    require_once 'Entities/Enums/RecurringType.php';
    require_once 'Entities/Enums/ReportType.php';
    require_once 'Entities/Enums/SecCode.php';
    require_once 'Entities/Enums/TaxType.php';
    require_once 'Entities/Enums/TransactionModifier.php';
    require_once 'Entities/Enums/TransactionType.php';
    require_once 'Entities/Exceptions/ApiException.php';
    require_once 'Entities/Exceptions/ArgumentException.php';
    require_once 'Entities/Exceptions/BuilderException.php';
    require_once 'Entities/Exceptions/ConfigurationException.php';
    require_once 'Entities/Exceptions/GatewayException.php';
    require_once 'Entities/Exceptions/NotImplementedException.php';
    require_once 'Entities/Exceptions/UnsupportedTransactionException.php';



    // Services
    require_once 'Services/HpsCentinelConfig.php';
    require_once 'Services/HpsServicesConfig.php';
    require_once 'Services/Gateway/HpsCentinelGatewayService.php';
    require_once 'Services/Gateway/HpsRestGatewayService.php';
    require_once 'Services/Gateway/HpsSoapGatewayService.php';
    require_once 'Services/Gateway/HpsBatchService.php';
    require_once 'Services/Gateway/HpsCheckService.php';
    require_once 'Services/Gateway/HpsCreditService.php';
    require_once 'Services/Gateway/HpsDebitService.php';
    require_once 'Services/Gateway/HpsGiftCardService.php';
    require_once 'Services/Gateway/HpsPayPlanService.php';
    require_once 'Services/Gateway/HpsTokenService.php';
    require_once 'Services/Gateway/HpsAttachmentService.php';
    require_once 'Services/Gateway/AltPayment/HpsAltPaymentService.php';
    require_once 'Services/Gateway/AltPayment/HpsPayPalService.php';
    require_once 'Services/Gateway/AltPayment/HpsMasterPassService.php';
    require_once 'Services/Gateway/PayPlan/HpsPayPlanCustomerService.php';
    require_once 'Services/Gateway/PayPlan/HpsPayPlanPaymentMethodService.php';
    require_once 'Services/Gateway/PayPlan/HpsPayPlanScheduleService.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceAuthorizeBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceCaptureBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceChargeBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceCpcEditBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceEditBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceGetBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceListTransactionsBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceOfflineAuthBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceOfflineChargeBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServicePrepaidAddValueBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServicePrepaidBalanceInquiryBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceRecurringBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceRefundBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceReverseBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceVerifyBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceVoidBuilder.php';
    require_once 'Services/Fluent/Gateway/Check/HpsCheckServiceOverrideBuilder.php';
    require_once 'Services/Fluent/Gateway/Check/HpsCheckServiceRecurringBuilder.php';
    require_once 'Services/Fluent/Gateway/Check/HpsCheckServiceReturnBuilder.php';
    require_once 'Services/Fluent/Gateway/Check/HpsCheckServiceSaleBuilder.php';
    require_once 'Services/Fluent/Gateway/Check/HpsCheckServiceVoidBuilder.php';
    require_once 'Services/Fluent/Gateway/Debit/HpsDebitServiceAddValueBuilder.php';
    require_once 'Services/Fluent/Gateway/Debit/HpsDebitServiceChargeBuilder.php';
    require_once 'Services/Fluent/Gateway/Debit/HpsDebitServiceReturnBuilder.php';
    require_once 'Services/Fluent/Gateway/Debit/HpsDebitServiceReverseBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceActivateBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceAddValueBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceAliasBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceBalanceBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceDeactivateBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceReplaceBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceReverseBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceRewardBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceSaleBuilder.php';
    require_once 'Services/Fluent/Gateway/GiftCard/HpsGiftCardServiceVoidBuilder.php';
    require_once 'Services/Fluent/Gateway/Credit/HpsCreditServiceUpdateTokenExpirationBuilder.php';
    require_once 'Services/Fluent/Gateway/HpsFluentCheckService.php';
    require_once 'Services/Fluent/Gateway/HpsFluentCreditService.php';
    require_once 'Services/Fluent/Gateway/HpsFluentDebitService.php';
    require_once 'Services/Fluent/Gateway/HpsFluentGiftCardService.php';

    // Cleanup
    ini_set('include_path', $originalPath);
}
