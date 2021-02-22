<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TestComponent extends CBitrixComponent
{
    public function newsIDsWithTheirSections()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", $this->arParams["USER_SECTION_PROP_CODE"]);
        $sections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);

        while ($section = $sections->Fetch()) {
            foreach ($section[$this->arParams["USER_SECTION_PROP_CODE"]] as $newsID) {
                if (array_key_exists($newsID, $this->arResult["NEWS"])) {
                    array_push($this->arResult["NEWS"][$newsID]["SECTION_IDS"], $section["ID"]);
                    array_push($this->arResult["NEWS"][$newsID]["SECTION_NAMES"], $section["NAME"]);
                } else {
                    $this->arResult["NEWS"][$newsID]["SECTION_IDS"] = array($section["ID"]);
                    $this->arResult["NEWS"][$newsID]["SECTION_NAMES"] = array($section["NAME"]);
                }
            }
        }
    }

    public function productsGroupedByNews()
    {
        foreach ($this->arResult["NEWS"] as $newsID => $sectionsIDs) {

            $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_NEWS"], "ID" => $newsID, "ACTIVE" => "Y");
            $arSelect = array("NAME", "DATE_ACTIVE_FROM");
            $singleNews = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

            $newsValues = $singleNews->Fetch();
            $this->arResult["RESULT"][$newsValues["NAME"]]["NEWS_VALUES"] = $newsValues;
            $this->arResult["RESULT"][$newsValues["NAME"]]["NEWS_VALUES"]["SECTION_NAMES"] = $this->arResult["NEWS"][$newsID]["SECTION_NAMES"];

            foreach ($sectionsIDs["SECTION_IDS"] as $sectionsID) {

                $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "IBLOCK_SECTION_ID" => $sectionsID, "ACTIVE" => "Y");
                $arSelect = array("ID", "IBLOCK_SECTION_ID", 'NAME', "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER"); //
                $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

                while ($product = $elements->Fetch()) {
                    $this->arResult["RESULT"][$newsValues["NAME"]]["PRODUCTS"][$product["NAME"]] = $product;
                }
            }
        }
    }

    public function countElements()
    {
        $numberOfElements = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"]), array(), false, array());
        $this->arResult["COUNTER"] = $numberOfElements;
        $this->SetResultCacheKeys(array("COUNTER"));

        return $numberOfElements;
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->newsIDsWithTheirSections();
            $this->productsGroupedByNews();
            $this->countElements();
            $this->IncludeComponentTemplate();
        }

        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . $this->arResult['COUNTER']);
    }
}