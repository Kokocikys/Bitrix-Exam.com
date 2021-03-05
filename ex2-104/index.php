<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ex2-104"); ?>

<? $APPLICATION->IncludeComponent(
    "custom:complaintsHandler",
    ".default",
    array()
); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>