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
        "IBLOCK_ID_NEWS" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_NEWS"),
            "TYPE" => "LIST",
            "VALUES" => $arIblock,
            "MULTIPLE" => "N",
        ),
        "USER_SECTION_PROP_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("USER_SECTION_PROP_CODE"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME" => array(
            "DEFAULT" => 36000000,
        ),
    ),
);