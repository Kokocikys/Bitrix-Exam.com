<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arResult["MIN_PRICE"]) && isset($arResult["MAX_PRICE"])) {

    $content = "Минимальная цена: " . $arResult["MIN_PRICE"] . "<br>" . "Максимальная цена: " . $arResult["MAX_PRICE"];

    $message = '<div style="color:red; margin: 34px 15px 35px 15px">' . $content . '</div>';

    $APPLICATION->AddViewContent('ex2-82', $message);
}

