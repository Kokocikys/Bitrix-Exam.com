<?php

AddEventHandler("main", "OnBeforeEventAdd", array("Ex2", "Ex2_51"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("Ex2", "Ex2_50"));

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

    function Ex2_50(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 2 && $arFields["ACTIVE"] == "N") {

            $arFilter = array("IBLOCK_ID" => $arFields["IBLOCK_ID"], "ID" => $arFields["ID"]);
            $arSelect = array("SHOW_COUNTER");
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

            $element = $res->Fetch();
            $count = $element["SHOW_COUNTER"];

            if ($count > 2)
            {
                global $APPLICATION;
                $APPLICATION->ThrowException("Товар невозможно деактивировать. Количество его просмотров: $count");
                return false;
            }
        }
    }
}