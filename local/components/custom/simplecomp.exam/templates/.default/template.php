<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    Метка времени: <?= $arResult["TIME"] ?><br>
    <a href="<?= $APPLICATION->GetCurPage() . "?F=Y" ?>">Применить фильтр</a>
    <ul>
        <? foreach ($arResult["FIRM"] as $firmID => $firmName) { ?>
            <li><?= $firmName ?></li>
            <ul>
                <? foreach ($arResult["PRODUCTS"][$firmID] as $product) { ?>
                    <li id="<?= $this->GetEditAreaId($product['ID']); ?>"><a
                                href="<?= $product["DETAIL_PAGE_URL"] ?>">
                            <?= $product["NAME"] ?> – <?= $product["PROPERTY_PRICE_VALUE"] ?>
                            – <?= $product["PROPERTY_MATERIAL_VALUE"] ?></a>
                    </li>
                <? } ?>
            </ul>
        <? } ?>
    </ul>
    <?= $arResult['NAVY'] ?>
</div>