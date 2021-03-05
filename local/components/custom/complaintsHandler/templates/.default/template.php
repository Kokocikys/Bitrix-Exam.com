<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div>
    <button class="complaint">Пожаловаться на новость</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".complaint").on('click', function () {
            alert("1");
            BX.ajax.runAction('koko:complaints.api.test.add').then(function () {
                alert("2");
            })
        })
    })
</script>