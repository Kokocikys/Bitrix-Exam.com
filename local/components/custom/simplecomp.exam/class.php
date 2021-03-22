<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TestComponent extends CBitrixComponent
{
    public function getFirm()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CLASSIFIER"], "ACTIVE" => "Y", "CHECK_PERMISSIONS" => "Y");
        $arSelect = array("ID", "NAME");
        $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($firm = $elements->Fetch()) {
            $this->arResult["FIRM"][$firm["ID"]] = $firm["NAME"];
        }

        $this->arResult["COUNTER"] = $elements->SelectedRowsCount();
        $this->SetResultCacheKeys(array("COUNTER"));
    }

    public function getProducts()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"], "ACTIVE" => "Y", "CHECK_PERMISSIONS" => "Y");
        $arSelect = array("ID", "NAME", "PROPERTY_" . $this->arParams["USER_CODE"], "PROPERTY_PRICE", "PROPERTY_MATERIAL", "DETAIL_PAGE_URL");
        $products = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($product = $products->Fetch()) {
            $firmID = $product["PROPERTY_" . $this->arParams["USER_CODE"] . "_VALUE"];
            if (array_key_exists($firmID, $this->arResult["PRODUCTS"])) {
                array_push($this->arResult["PRODUCTS"][$firmID], $product);
            } else {
                $this->arResult["PRODUCTS"][$firmID] = array($product);
            }
        }
    }

    public function executeComponent()
    {
        global $USER;
        global $APPLICATION;

        $groups = $USER->GetGroups();

        if ($this->startResultCache(false, $groups)) {
            $this->getFirm();
            $this->getProducts();
            $this->IncludeComponentTemplate();
        }
        $APPLICATION->SetTitle("Количество разделов: " . $this->arResult['COUNTER']);
    }
}