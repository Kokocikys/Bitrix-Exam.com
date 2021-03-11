<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    <ul>
        <? foreach ($arResult["AUTHORS"] as $authorID => $authorLogin) { ?>
            <li><?= $authorID; ?> – <?= $authorLogin ?></li>
            <ul>
                <? foreach ($arResult["NEWS_LIST"][$authorID] as $newsName) { ?>
                    <li><?= $newsName ?></li>
                <? } ?>
            </ul>
        <? } ?>
    </ul>
</div>