<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class NewsComplaints extends CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->startResultCache()) {
            $this->IncludeComponentTemplate();
        }
    }
}