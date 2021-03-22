<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class TestComponent extends CBitrixComponent
{
    public function getFirm()
    {
        $arFilter = array(
            'IBLOCK_ID' => $this->arParams["IBLOCK_ID_CLASSIFIER"],
            "ACTIVE" => "Y",
        );
        $arSelect = array(
            "ID",
            "NAME",
        );
        $arNavParams = array(
            "nPageSize" => $this->arParams['ELEMENTS_ON_PAGE'],
            'bShowAll' => true,
        );
        $elements = CIBlockElement::GetList(
            array(),
            $arFilter,
            false,
            $arNavParams,
            $arSelect
        );

        $this->arResult['NAVY'] = $elements->GetPageNavString("Элементы", "modern", "Y");

        while ($firm = $elements->Fetch()) {
            $this->arResult["FIRM"][$firm["ID"]] = $firm["NAME"];
        }

        $this->arResult["COUNTER"] = $elements->SelectedRowsCount();
        $this->SetResultCacheKeys(array("COUNTER", "NAVY"));
    }

    public function getProducts()
    {
        $arFilter = array(
            'IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"],
            "ACTIVE" => "Y"
        );
        $arSelect = array(
            "ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PROPERTY_PRICE",
            "PROPERTY_MATERIAL",
            "PROPERTY_" . $this->arParams["USER_CODE"],
        );
        $products = CIBlockElement::GetList(
            array(),
            $arFilter,
            false,
            false,
            $arSelect
        );

        while ($product = $products->Fetch()) {
            $firmID = $product["PROPERTY_" . $this->arParams["USER_CODE"] . "_VALUE"];

            $this->arResult["PRODUCTS_COPY"][$product["ID"]] = $product;

            if (array_key_exists($firmID, $this->arResult["PRODUCTS"])) {
                array_push($this->arResult["PRODUCTS"][$firmID], $product);
            } else {
                $this->arResult["PRODUCTS"][$firmID] = array($product);
            }
        }
    }

    public function timeTag()
    {
        $this->arResult["TIME"] = time();
        $this->SetResultCacheKeys(array("TIME"));
    }

    public function executeComponent()
    {
        global $USER;
        global $APPLICATION;

        CModule::IncludeModule('iblock');

        $arNavigation = CDBResult::GetNavParams($arNavParams);

        if ($this->startResultCache(false, array($USER->GetGroups(), $arNavigation))) {
            $this->timeTag();
            $this->getFirm();
            $this->getProducts();
            $this->IncludeComponentTemplate();
        }
        $APPLICATION->SetTitle("Количество разделов: " . $this->arResult['COUNTER']);
    }
}