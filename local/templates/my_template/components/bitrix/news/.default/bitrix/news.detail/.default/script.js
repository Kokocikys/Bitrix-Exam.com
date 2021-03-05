$(document).ready(function () {
    $(".complaints").on('click', function () {
        BX.ajax.runAction('koko:complaints.api.test.add', {
            data: {
                news_id: $(".complaints").attr("data-news-id"),
                iblock_type_id: $(".complaints").attr("data-iblock-type-id"),
            }
        }).then(function (response) {
            if (response.status === "success" && response.data.errors.length == 0) {
                $(".complaints").hide();
                $(".complaintsMessage").text("Жалоба получена!").show();
            } else {
                $(".complaints").hide();
                $(".complaintsMessage").text(response.data.errors).show();
            }
        });
    });
});