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
        $arOrder = array(
            "NAME" => "ASC",
            "SORT" => "ASC",
        );

        if ($_REQUEST["F"]) {
            $arFilter = array(
                'IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"],
                "ACTIVE" => "Y",
                array(
                    "LOGIC" => "OR",
                    array("<=PROPERTY_PRICE" => 1700, "=PROPERTY_MATERIAL" => "Дерево, ткань"),
                    array("<PROPERTY_PRICE" => 1500, "=PROPERTY_MATERIAL" => "Металл, пластик"),
                ),
            );
        } else {
            $arFilter = array(
                'IBLOCK_ID' => $this->arParams["IBLOCK_ID_CATALOG"],
                "ACTIVE" => "Y"
            );
        }

        $arSelect = array(
            "ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PROPERTY_PRICE",
            "PROPERTY_MATERIAL",
            "PROPERTY_" . $this->arParams["USER_CODE"],
        );

        $products = CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            false,
            $arSelect
        );

        while ($product = $products->Fetch()) {

            $this->arResult["PRODUCTS_COPY"][$product["ID"]] = $product;

            $product["DETAIL_PAGE_URL"] = str_replace(
                array(
                    "#SITE_DOMAIN#",
                    "#SECTION_ID#",
                    "#ELEMENT_ID#",
                ),
                array(
                    SITE_SERVER_NAME,
                    $product["IBLOCK_SECTION_ID"],
                    $product["ID"],
                ),
                $this->arParams["DETAIL_VIEW"]
            );

            $firmID = $product["PROPERTY_" . $this->arParams["USER_CODE"] . "_VALUE"];

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

        if ($_REQUEST["F"]) $this->ClearResultCache(array($USER->GetGroups(), $arNavigation));

        if ($this->startResultCache(false, array($USER->GetGroups(), $arNavigation))) {

            if ($_REQUEST["F"]) $this->AbortResultCache();

            $this->timeTag();
            $this->getFirm();
            $this->getProducts();
            $this->IncludeComponentTemplate();
        }
        $APPLICATION->SetTitle("Количество разделов: " . $this->arResult['COUNTER']);
    }
}