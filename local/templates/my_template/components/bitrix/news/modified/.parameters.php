<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("SORT" => "ASC"), array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}

$arTemplateParameters = array(
    "CANONICAL" => array(
        "NAME" => "CANONICAL",
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
        "REFRESH" => "Y",
    ),
);

if ($arCurrentValues["CANONICAL"] == "Y") {
    $arTemplateParameters = array(
        "CANONICAL" => array(
            "NAME" => "CANONICAL",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
        ),
        "IBLOCK_TYPE_CANONICAL" => array(
            "NAME" => "Тип инфоблока",
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
        ),
        "IBLOCK_ID_CANONICAL" => array(
            "NAME" => "Инфоблок",
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
        )
    );
}