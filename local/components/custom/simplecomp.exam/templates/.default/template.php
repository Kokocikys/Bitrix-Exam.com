<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    <?php foreach ($arResult["NEWS"] as $values) { ?>
        <?= $values["NAME"] . " - " . $values["DATE_ACTIVE_FROM"]; ?>
        <div>(<?= implode(', ', $arResult["SECTIONS"][$values["ID"]]["SECTION_NAMES"]); ?>)
            <ul>
                <? foreach ($arResult["PRODUCTS"][$values["ID"]] as $product) { ?>
                    <li>
                        <?= $product["NAME"] . " - " . $product["PROPERTY_PRICE_VALUE"] . " - " . $product["PROPERTY_MATERIAL_VALUE"] . " - " . $product["PROPERTY_ARTNUMBER_VALUE"]; ?>
                    </li>
                <? } ?>
            </ul>
        </div>
    <? } ?>
</div>