<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("iblock");

$dbIBlocks = CIBlock::GetList(
    array("SORT" => "ASC"),
    array("ACTIVE" => "Y")
);
while ($arIBlocks = $dbIBlocks->Fetch()) {
    $arIblock[$arIBlocks["ID"]] = "[" . $arIBlocks["ID"] . "] " . $arIBlocks["NAME"];
}

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "IBLOCK_ID_CATALOG" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_CATALOG"),
            "TYPE" => "LIST",
            "VALUES" => $arIblock,
            "MULTIPLE" => "N",
        ),
        "IBLOCK_ID_CLASSIFIER" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_CLASSIFIER"),
            "TYPE" => "LIST",
            "VALUES" => $arIblock,
            "MULTIPLE" => "N",
        ),
        "USER_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("USER_CODE"),
            "TYPE" => "STRING",
        ),
        "DETAIL_VIEW" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("DETAIL_VIEW"),
            "TYPE" => "STRING",
            "DEFAULT" => "#SITE_DIR#/products/#SECTION_ID#/#ELEMENT_ID#",
        ),
        "ELEMENTS_ON_PAGE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ELEMENTS_ON_PAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => 2,
        ),
        "CACHE_TIME" => array(
            "DEFAULT" => 36000000,
        ),
    ),
);