<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams["CANONICAL"] != "") {

    $arFilter = array("IBLOCK_ID" => $arParams["CANONICAL"], "ACTIVE" => "Y"); // По чему фильтруем
    $arSelect = array("ID", "NAME"); // Что хотим получить

    $listOfElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect); // Возвращает список элементов по фильтру arFilter
    while ($element = $listOfElements->GetNextElement()) { // циклом создаем переменную с элементом и проходим по каждому из них
        $arFields = $element->GetFields(); // получаем все поля, которые хранятся в $element
        $db_props = CIBlockElement::GetProperty($arParams["CANONICAL"], $arFields["ID"]); // Получаем значения свойства
        $ar_props = $db_props->Fetch(); // Создаем массив из значений полей $element

        if ($arParams["ELEMENT_ID"] == $ar_props["VALUE"]) { // Сравниваем, совпадают ли ID новости из инфоблока Новости и значение свойства элемента цикла инфоблока Canonical
            $APPLICATION->SetPageProperty('CANONICAL', $arFields["NAME"]); // Задаем значение для CANONICAL
        }
    }
}