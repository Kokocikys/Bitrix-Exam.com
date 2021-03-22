<?php

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("Ex2", "Ex2_107"));

class Ex2
{
    function Ex2_107(&$arFields)
    {
        if ($arFields['IBLOCK_ID'] == 5) {
            CBitrixComponent::clearComponentCache('custom:simplecomp.exam');
        }
    }
}