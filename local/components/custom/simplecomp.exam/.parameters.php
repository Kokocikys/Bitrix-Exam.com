<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("iblock");

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arFilter["ACTIVE"] = "Y";
if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter["TYPE"] = $arCurrentValues['IBLOCK_TYPE'];
}
$rsIBlock = CIBlock::GetList(
    array("SORT" => 'ASC'),
    $arFilter,
);
while ($iblock = $rsIBlock->Fetch()) {
    $arIBlocks[$iblock['ID']] = '[' . $iblock['ID'] . '] ' . $iblock['NAME'];
}

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "CACHE_TIME" => array(
            "DEFAULT" => 36000000,
        ),
        'IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage("IBLOCK_TYPE"),
            'TYPE' => 'LIST',
            'VALUES' => $arIBlockType,
            'REFRESH' => 'Y',
            'MULTIPLE' => 'N'
        ),
        'IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage("IBLOCK_ID"),
            'TYPE' => 'LIST',
            'VALUES' => $arIBlocks,
            'MULTIPLE' => 'N'
        ),
        "USER_PROPERTY" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("USER_PROPERTY"),
            "TYPE" => "STRING",
        ),
    ),
);