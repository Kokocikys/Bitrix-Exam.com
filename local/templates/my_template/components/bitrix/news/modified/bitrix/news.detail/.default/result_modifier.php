<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams["CANONICAL"] == "Y") {

    $arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID_CANONICAL"], "VALUE" => $arParams["ELEMENT_ID"], "ACTIVE" => "Y"); // Ищем значение свойства элемента, которого соответствует ID новости
    $arSelect = array("NAME"); // Что хотим получить
    $element = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect); // Записываем первый элемент, значение ID привязанного элемента которого соответствует ID новости
    $propsValues = $element->Fetch(); // Записываем массив значений свойств элемента

    $cp = $this->__component;// объект компонента
    if (is_object($cp)) {
        $cp->arResult['CANONICAL_VALUE'] = $propsValues["NAME"]; // добавим в arResult компонента поле CANONICAL_VALUE
        $cp->SetResultCacheKeys(array('CANONICAL_VALUE')); // сохраним их в копии arResult, с которой работает шаблон
    }
}