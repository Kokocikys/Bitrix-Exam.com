<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arPrice = array();

foreach ($arResult["PRODUCTS"] as $products) {
    foreach ($products as $product) {
        $arPrice[] = $product["PROPERTY_PRICE_VALUE"];
    }
}

$arResult["MIN_PRICE"] = min($arPrice);
$arResult["MAX_PRICE"] = max($arPrice);

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(array("MIN_PRICE", "MAX_PRICE"));
}