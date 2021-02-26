<?php

$module_id = "koko.complaints";

use Bitrix\Main\Loader;

if (!$USER->IsAdmin() && !Loader::includeModule($module_id)) {
    return;
}

$aTabs = array(
    array("DIV" => "edit1",
        "TAB" => "Основные настройки",
        "ICON" => "sender_settings",
        "TITLE" => "Настройки",
    ),
);

$arAllOptions = array(
    array("TEXTAREA_VALUES", "Введите текст", "Введите текст", array("textarea", 10, 100)),
    array("CHECKBOX_VALUES", "Согласны", "N", array("checkbox")),
);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['Update'] <> "" && check_bitrix_sessid()) {
    foreach ($arAllOptions as $arOption)
    {
        $name = $arOption[0];
        $val = $_REQUEST[$name];

        if ($arOption[3][0] == "checkbox" && $val != "Y") {
            $val = $arOption[2];
        } elseif ($arOption[3][0] == "textarea" && $val == "") {
            $val = $arOption[2];
        }
        COption::SetOptionString($module_id, $name, $val, $arOption[1]);
    }
}

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();
?>
    <form method="POST"
          action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&lang=<?= LANGUAGE_ID ?>">
        <? $tabControl->BeginNextTab(); ?>
        <? foreach ($arAllOptions as $arOption) {
            $type = $arOption[3];
            $val = COption::GetOptionString($module_id, $arOption[0], $arOption[2]); ?>
            <label for="<? echo htmlspecialcharsbx($arOption[0]) ?>"><? echo $arOption[1] ?>:</label>
            <? if ($type[0] == "checkbox"): ?>
                <input type="checkbox" id="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                       name="<? echo htmlspecialcharsbx($arOption[0]) ?>"
                       value="Y"<? if ($val == "Y") echo " checked"; ?>>
            <? elseif ($type[0] == "textarea"): ?>
                <br><textarea rows="<? echo $type[1] ?>" cols="<? echo $type[2] ?>"
                              name="<? echo htmlspecialcharsbx($arOption[0]) ?>"><? echo htmlspecialcharsbx($val) ?></textarea>
                <br>
            <? endif; ?>
        <? } ?>

        <? $tabControl->Buttons(); ?>
        <input type="submit" name="Update" value="<?= "Сохранить" ?>"
               title="Сохранить" class="adm-btn-save">
        <?= bitrix_sessid_post(); ?>
    </form>
<? $tabControl->End(); ?>