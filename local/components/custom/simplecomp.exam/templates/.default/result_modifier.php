<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult["PRODUCTS_COPY"] as $product) {

    $arButtons = CIBlock::GetPanelButtons(
        $product["IBLOCK_ID"],
        $product["ID"],
        0,
        array(
            "SECTION_BUTTONS" => false,
            "SESSID" => false
        )
    );
    $product["ADD_LINK"] = $arButtons["edit"]["add_element"]["ACTION_URL"];
    $product["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
    $product["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

    $product["ADD_LINK_TEXT"] = $arButtons["edit"]["add_element"]["TEXT"];
    $product["EDIT_LINK_TEXT"] = $arButtons["edit"]["edit_element"]["TEXT"];
    $product["DELETE_LINK_TEXT"] = $arButtons["edit"]["delete_element"]["TEXT"];

    $this->AddEditAction($product['ID'], $product['ADD_LINK'], $product["ADD_LINK_TEXT"]);
    $this->AddEditAction($product['ID'], $product['EDIT_LINK'], $product["EDIT_LINK_TEXT"]);
    $this->AddDeleteAction($product['ID'], $product['DELETE_LINK'], $product["DELETE_LINK_TEXT"], array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
}