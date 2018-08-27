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
    require_once 'Entities/Reporting/AltPaymentData.php';
    require_once 'Entities/Reporting/AltPaymentProcessorInfo.php';
    require_once 'Entities/Reporting/CheckData.php';
    require_once 'Entities/Reporting/LodgingData.php';
    require_once 'Entities/Reporting/SearchCriteria.php';
    require_once 'Entities/Reporting/SearchCriteriaBuilder.php';
    require_once 'Entities/Reporting/TransactionSummary.php';

    // Gateways
    require_once 'Gateways/Gateway.php';
    require_once 'Gateways/GatewayResponse.php';
    require_once 'Gateways/IPaymentGateway.php';
    require_once 'Gateways/IRecurringService.php';
    require_once 'Gateways/PayPlanConnector.php';
    require_once 'Gateways/PorticoConnector.php';
    require_once 'Gateways/RealexConnector.php';
    require_once 'Gateways/RestGateway.php';
    require_once 'Gateways/XmlGateway.php';

    // PaymentMethods
    require_once 'PaymentMethods/Cash.php';
    require_once 'PaymentMethods/Credit.php';
    require_once 'PaymentMethods/CreditCardData.php';
    require_once 'PaymentMethods/CreditTrackData.php';
    require_once 'PaymentMethods/Debit.php';
    require_once 'PaymentMethods/DebitTrackData.php';
    require_once 'PaymentMethods/EBT.php';
    require_once 'PaymentMethods/EBTCardData.php';
    require_once 'PaymentMethods/EBTTrackData.php';
    require_once 'PaymentMethods/ECheck.php';
    require_once 'PaymentMethods/GiftCard.php';
    require_once 'PaymentMethods/RecurringPaymentMethod.php';
    require_once 'PaymentMethods/TransactionReference.php';
    require_once 'PaymentMethods/Interfaces/IAuthable.php';
    require_once 'PaymentMethods/Interfaces/IBalanceable.php';
    require_once 'PaymentMethods/Interfaces/ICardData.php';
    require_once 'PaymentMethods/Interfaces/IChargable.php';
    require_once 'PaymentMethods/Interfaces/IEditable.php';
    require_once 'PaymentMethods/Interfaces/IEncryptable.php';
    require_once 'PaymentMethods/Interfaces/IPaymentMethod.php';
    require_once 'PaymentMethods/Interfaces/IPinProtected.php';
    require_once 'PaymentMethods/Interfaces/IPrePayable.php';
    require_once 'PaymentMethods/Interfaces/IRefundable.php';
    require_once 'PaymentMethods/Interfaces/IReversable.php';
    require_once 'PaymentMethods/Interfaces/ITokenizable.php';
    require_once 'PaymentMethods/Interfaces/ITrackData.php';
    require_once 'PaymentMethods/Interfaces/IVerifyable.php';
    require_once 'PaymentMethods/Interfaces/IVoidable.php';    

    // Services
    require_once 'Services/BatchService.php'; 
    require_once 'Services/CreditService.php'; 
    require_once 'Services/HostedService.php'; 
    require_once 'Services/RecurringService.php'; 
    require_once 'Services/ReportingService.php';   

    //Utils
    require_once 'Utils/GenerationUtils.php';

    // Cleanup
    ini_set('include_path', $originalPath);
}
