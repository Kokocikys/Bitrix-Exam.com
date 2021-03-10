<?php

AddEventHandler("main", "OnEpilog", array("Ex2", "Ex2_94"));

class Ex2
{
    function Ex2_94()
    {
        global $APPLICATION;

        CModule::IncludeModule("iblock");

        $arFilter = array("IBLOCK_ID" => 5, "NAME" => $APPLICATION->GetCurPage());
        $arSelect = array("PROPERTY_TITLE", "PROPERTY_DESC");
        $element = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect)->Fetch();

        $APPLICATION->SetPageProperty("title", $element["PROPERTY_TITLE_VALUE"]);
        $APPLICATION->SetPageProperty("description", $element["PROPERTY_DESC_VALUE"]);
    }
}