<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class InterestNews extends CBitrixComponent
{
    public function authorsList()
    {
        global $USER;

        $user = CUser::GetByID($USER->GetID());
        $userValues = $user->Fetch();

        $currentGroup = $userValues[$this->arParams["USER_PROPERTY"]];
        $currentUserID = $userValues["ID"];

        $arFilter = array(
            "ACTIVE" => "Y",
            "!ID" => $currentUserID,
            $this->arParams["USER_PROPERTY"] => $currentGroup,
        );
        $arParams["SELECT"] = array(
            $this->arParams["USER_PROPERTY"],
        );
        $usersList = CUser::GetList(($by = "ID"), ($order = "ASC"), $arFilter, $arParams);

        while ($t = $usersList->Fetch()) {
            $this->arResult["AUTHORS"][$t["ID"]] = $t["LOGIN"];
        }
    }

    public function newsList()
    {
        $arFilter = array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"], "ACTIVE" => "Y");
        $arSelect = array("ID", "NAME", "PROPERTY_AUTHOR_ID");
        $elements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        while ($news = $elements->Fetch()) {
            if (array_key_exists($news["PROPERTY_AUTHOR_ID_VALUE"], $this->arResult["NEWS_LIST"])) {
                array_push($this->arResult["NEWS_LIST"][$news["PROPERTY_AUTHOR_ID_VALUE"]], $news["NAME"]);
            } else {
                $this->arResult["NEWS_LIST"][$news["PROPERTY_AUTHOR_ID_VALUE"]] = array($news["NAME"]);
            }
        }
    }

    public function counter()
    {
        $allNews = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $this->arParams["IBLOCK_ID"]), false, false, array());
        $this->arResult["COUNTER"] = $allNews->SelectedRowsCount();
        $this->SetResultCacheKeys(array("COUNTER"));
    }

    public function executeComponent()
    {
        global $USER;

        if ($USER->IsAuthorized()) {
            if ($this->startResultCache(false, $USER->GetID())) {
                $this->authorsList();
                $this->newsList();
                $this->counter();
                $this->IncludeComponentTemplate();
            }
            global $APPLICATION;
            $APPLICATION->SetTitle("Количество новостей: " . $this->arResult['COUNTER']);
        }
    }
}