<?php

use Bitrix\Main\Mail\Event;
use Bitrix\Main\Config\Option;

function CheckUserCount()
{
    $newDate = time();
    $lastDate = Option::get("main", "last_update_chechUserCount");
    $dateDiff = $newDate - $lastDate;

    if ($lastDate) {
        $arFilter = array("DATE_REGISTER_1" => ConvertTimeStamp($lastDate, "FULL"));
    } else {
        $arFilter = array();
    }

    $rsUser = CUser::GetList(($by = "ID"), ($order = "DESC"), $arFilter);
    while ($user = $rsUser->Fetch()) {
        $count++;
    }

    $days = round($dateDiff / (3600 * 24));

    $rsAdmin = CUser::GetList(($by = "ID"), ($order = "DESC"), array("GROUPS_ID" => 1));
    while ($admin = $rsAdmin->Fetch()) {
        Event::send(array(
            "EVENT_NAME" => "USERS_COUNTER",
            "LID" => "s1",
            "C_FIELDS" => array(
                "EMAIL_TO" => $admin["EMAIL"],
                "COUNT" => $count,
                "DAYS" => $days,
            ),
        ));
    }

    Option::set("main", "last_update_chechUserCount", $newDate);

    return "CheckUserCount();";
}