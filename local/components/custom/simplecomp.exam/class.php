<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TestComponent extends CBitrixComponent
{
    public function newsWithGroupedSections()
    {
        $arNews = array();

        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", "UF_*");
        $sections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);

        while ($section = $sections->Fetch()) {
            foreach ($section[$this->arParams["USER_SECTION_PROP_CODE"]] as $newsID) {
                if (array_key_exists($newsID, $arNews)) {
                    array_push($arNews[$newsID]["SECTION_IDs"], $section["ID"]);
                    array_push($arNews[$newsID]["SECTION_NAMEs"], $section["NAME"]);
                } else {
                    $arNews[$newsID]["SECTION_IDs"] = array($section["ID"]);
                    $arNews[$newsID]["SECTION_NAMEs"] = array($section["NAME"]);
                }
            }
        }
        return $arNews;
    }

    public function productsGroupedByNews()
    {
        $result = array();
        $newsWithGroupedSections = $this->newsWithGroupedSections();

        foreach ($newsWithGroupedSections as $newsID => $sectionsIDs) {

            $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_NEWS"], "ID" => $newsID, "ACTIVE" => "Y");
            $arSelect = array("NAME", "DATE_ACTIVE_FROM");
            $singleNews = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

            $newsValues = $singleNews->Fetch();
            $result[$newsValues["NAME"]]["NEWS_VALUES"] = $newsValues;
            $result[$newsValues["NAME"]]["NEWS_VALUES"]["SECTION_NAMES"] = $newsWithGroupedSections[$newsID]["SECTION_NAMEs"];

            $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y"); //'SECTION_ID' => $sectionsID,
            $arSelect = array("ID", "IBLOCK_SECTION_ID", 'NAME', "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER"); //
            $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

            while ($product = $elements->Fetch()) {
                $counter++;
                foreach ($sectionsIDs["SECTION_IDs"] as $sectionsID) {
                    if ($product["IBLOCK_SECTION_ID"] == $sectionsID) {
                        $result[$newsValues["NAME"]]["PRODUCTS"][$product["NAME"]] = $product;
                    }
                }
            }
            $this->arResult["COUNTER"] = $counter;
            $counter = 0;
        }
        return $result;
    }

    public function executeComponent()
    {

        $this->arResult["RESULT"] = $this->productsGroupedByNews();
        $this->IncludeComponentTemplate();
        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . $this->arResult['COUNTER']);
    }
}