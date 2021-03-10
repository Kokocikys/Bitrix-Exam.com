<?php

include(GetLangFileName(dirname(__FILE__) . "/", "/init.php"));
AddEventHandler("main", "OnBeforeEventAdd", array("Ex2", "Ex2_51"));

class Ex2
{
    function Ex2_51(&$event, &$lid, &$arFields)
    {
        if ($event = "FEEDBACK_FORM") {

            global $USER;

            if ($USER->IsAuthorized()) {
                $arFields["AUTHOR"] = getMessage("AUTH_USER", array(
                    "#ID#" => $USER->getID(),
                    "#LOGIN#" => $USER->getLogin(),
                    "#NAME#" => $USER->GetFullName(),
                    "#NAME_FORM#" => $arFields["AUTHOR"],
                ));
            } else {
                $arFields["AUTHOR"] = getMessage("NOT_AUTH_USER", array(
                    "#NAME_FORM#" => $arFields["AUTHOR"],
                ));
            }

            CEventLog::Add(array(
                "SEVERITY" => "SEVERITY",
                "AUDIT_TYPE_ID" => "AUDIT_TYPE_ID",
                "MODULE_ID" => "main",
                "ITEM_ID" => $event,
                "DESCRIPTION" => getMessage("REPLACEMENT") . $arFields["AUTHOR"],
            ));
        }
    }
}