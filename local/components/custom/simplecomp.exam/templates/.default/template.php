<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    <? if (!empty($arResult["RESULT"])) { ?>
        <?php foreach ($arResult["RESULT"] as $newsName => $values) { ?>
            <div><?= $newsName . " - " . $values["NEWS_VALUES"]["DATE_ACTIVE_FROM"]; ?>
                <div>(<?= implode(', ', $values["NEWS_VALUES"]["SECTION_NAMES"]); ?>)
                    <ul>
                        <? foreach ($values["PRODUCTS"] as $product) { ?>
                            <li>
                                <?= $product["NAME"] . " - " . $product["PROPERTY_PRICE_VALUE"] . " - " . $product["PROPERTY_MATERIAL_VALUE"] . " - " . $product["PROPERTY_ARTNUMBER_VALUE"]; ?>
                            </li>
                        <? } ?>
                    </ul>
                </div>
            </div>
        <? } ?>
    <? } ?>
</div>