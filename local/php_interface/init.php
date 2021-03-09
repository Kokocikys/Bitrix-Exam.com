<?php

AddEventHandler("main", "OnEpilog", array("Ex2", "Ex2_93"), 1);

class Ex2
{
    function Ex2_93()
    {
        if ((defined('ERROR_404') && ERROR_404 == 'Y')) {

            global $APPLICATION;

            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "ERROR_404",
                "MODULE_ID" => "main",
                "DESCRIPTION" => $APPLICATION->GetCurPage(),
            ));

            $APPLICATION->RestartBuffer();

            require $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/header.php";
            require $_SERVER["DOCUMENT_ROOT"] . "/404.php";
            require $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/footer.php";
        }
    }
}