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

    public function arrayOfElements()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y");
        $arSelect = array("ID", 'NAME', "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER"); //
        $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($element = $elements->Fetch()) {
            $this->arResult["ELEMENTS"][$element["ID"]] = $element;
        }

        $this->arResult["COUNTER"] = $elements->SelectedRowsCount();;
        $this->SetResultCacheKeys(array("COUNTER"));
    }

    public function productsGroupedByNews()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_NEWS"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM");
        $news = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($newsValues = $news->Fetch()) {

            foreach ($this->arResult["NEWS"] as $newsID => $sectionsIDs) {

                if ($newsValues["ID"] == $newsID) {

                    $this->arResult["RESULT"][$newsValues["NAME"]]["NEWS_VALUES"] = $newsValues;
                    $this->arResult["RESULT"][$newsValues["NAME"]]["NEWS_VALUES"]["SECTION_NAMES"] = $this->arResult["NEWS"][$newsID]["SECTION_NAMES"];

                    foreach ($this->arResult["ELEMENTS"] as $ELEMENT) {

                        foreach ($sectionsIDs["SECTION_IDS"] as $sectionsID) {

                            if ($ELEMENT["IBLOCK_SECTION_ID"] == $sectionsID) {
                                $this->arResult["RESULT"][$newsValues["NAME"]]["PRODUCTS"][$ELEMENT["NAME"]] = $ELEMENT;
                            }
                        }
                    }
                }
            }
        }
    }

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->arrayOfElements();
            $this->newsIDsWithTheirSections();
            $this->productsGroupedByNews();
            $this->IncludeComponentTemplate();
        }

        global $APPLICATION;
        $APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . $this->arResult['COUNTER']);
    }
}