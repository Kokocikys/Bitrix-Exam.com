<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$firstNews = $arResult["ITEMS"][0]["ACTIVE_FROM"];

$cp = $this->__component;

if (is_object($cp)) {
    $cp->arResult['FIRST_NEWS'] = $firstNews;
    $cp->SetResultCacheKeys(array('FIRST_NEWS'));
}