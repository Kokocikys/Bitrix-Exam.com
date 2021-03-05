<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class NewsComplaints extends CBitrixComponent
{
    //\Bitrix\Main\Loader::includeModule("koko.complaints");
//use \Koko\Complaints\ComplaintTable;

    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->IncludeComponentTemplate();
        }
    }
}