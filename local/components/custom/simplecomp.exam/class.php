<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TestComponent extends CBitrixComponent
{
    public function sectionsSortedByNews()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", $this->arParams["USER_SECTION_PROP_CODE"]);
        $sections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);

        while ($section = $sections->Fetch()) {
            foreach ($section[$this->arParams["USER_SECTION_PROP_CODE"]] as $newsID) {
                if (array_key_exists($newsID, $this->arResult["SECTIONS"])) {
                    array_push($this->arResult["SECTIONS"][$newsID]["SECTION_IDS"], $section["ID"]);
                    array_push($this->arResult["SECTIONS"][$newsID]["SECTION_NAMES"], $section["NAME"]);
                } else {
                    $this->arResult["SECTIONS"][$newsID]["SECTION_IDS"] = array($section["ID"]);
                    $this->arResult["SECTIONS"][$newsID]["SECTION_NAMES"] = array($section["NAME"]);
                }
            }
        }
    }

    public function arrayOfElements()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y");
        $arSelect = array("ID", 'NAME', "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER"); //
        $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($element = $elements->Fetch()) {
            foreach ($this->arResult["SECTIONS"] as $newsID => $sectionIDs) {
                foreach ($sectionIDs["SECTION_IDS"] as $sectionID) {
                    if ($sectionID == $element["IBLOCK_SECTION_ID"]) {
                        $this->arResult["PRODUCTS"][$newsID][$element["NAME"]] = $element;
                    }
                }
            }
        }
        $this->arResult["COUNTER"] = $elements->SelectedRowsCount();
        $this->SetResultCacheKeys(array("COUNTER"));
    }

    public function arrayOfNews()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_NEWS"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
        $news = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($newsValue = $news->Fetch()) {
            $this->arResult["NEWS"][$newsValue["ID"]] = $newsValue;
        }
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->sectionsSortedByNews();
            $this->arrayOfNews();
            $this->arrayOfElements();
            $this->IncludeComponentTemplate();
        }
        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . $this->arResult['COUNTER']);
    }
}