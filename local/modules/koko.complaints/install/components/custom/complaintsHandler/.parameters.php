<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("koko.complaints");
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
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arIblock,
            "MULTIPLE" => "N",
        ),
        "CACHE_TIME" => array(
            "DEFAULT" => 36000000,
        ),
    ),
);