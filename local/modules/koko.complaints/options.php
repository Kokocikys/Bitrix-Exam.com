<?php

$module_id = "koko.complaints";

use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

global $USER;
global $APPLICATION;

Loader::includeModule($module_id);
if (!Loader::includeModule($module_id)) {
    return;
}

$MOD_RIGHT = $APPLICATION->GetGroupRight($module_id);
if ($MOD_RIGHT >= "R"):

    $aTabs = array(
        array("DIV" => "edit1",
            "TAB" => "Основные настройки",
            "ICON" => "sender_settings",
            "TITLE" => "Настройки",
        ),
    );

    $arOptions = array(
        'IBLOCK_TYPE_ID' => array(
            'TYPE' => 'STRING',
            'TITLE' => "Введите доступный ID типа ИБ"
        ),
    );

    if ($MOD_RIGHT >= "W" && $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['Update'] <> "" && check_bitrix_sessid()) {
        $ok = true;
        foreach ($arOptions as $code => $v)
            $ok = $ok && $_REQUEST[$code];
        if ($ok) {
            foreach ($arOptions as $code => $v) {
                $method = "SetOption{$v['TYPE']}";
                COption::$method($module_id, $code, $_REQUEST[$code], $v['TITLE']);
            }
        }
    }

    $tabControl = new CAdminTabControl("tabControl", $aTabs); ?>

    <? $tabControl->Begin(); ?>
    <form method="POST"
          action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($module_id) ?>&lang=<?= LANGUAGE_ID ?>">
        <? $tabControl->BeginNextTab(); ?>
        <? foreach ($arOptions as $code => $v): ?>
            <tr>
                <td width="40%">
                    <label for="WSDL"><?= $v['TITLE'] ?></label>
                </td>
                <td width="60%">
                    <input type="text" size="50" maxlength="200" name="<?= $code ?>" id="<?= $code ?>"
                           value="<?= htmlspecialcharsbx(Option::get($module_id, $code)) ?>">
                </td>
            </tr>
        <? endforeach ?>
        <? $tabControl->Buttons(); ?>
        <input type="submit" name="Update" value="Сохранить" title="Сохранить" class="adm-btn-save">
        <?= bitrix_sessid_post(); ?>
    </form>
    <? $tabControl->End(); ?>

<? endif;//if($MOD_RIGHT>="R"): ?>

