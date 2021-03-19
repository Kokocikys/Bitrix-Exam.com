<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?><? $APPLICATION->IncludeComponent(
    "bitrix:news",
    "modified",
    array(
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "1",
        "NEWS_COUNT" => "5",
        "USE_SEARCH" => "N",
        "USE_RSS" => "Y",
        "NUM_NEWS" => "20",
        "NUM_DAYS" => "30",
        "YANDEX" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/news/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_SHADOW" => "N",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_PANEL" => "N",
        "SET_TITLE" => "Y",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "USE_PERMISSIONS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PAGER_TEMPLATE" => "arrows",
        "DETAIL_PAGER_SHOW_ALL" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "COMPONENT_TEMPLATE" => "modified",
        "USE_REVIEW" => "N",
        "SET_LAST_MODIFIED" => "N",
        "ADD_ELEMENT_CHAIN" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "CANONICAL" => "5",
        "SEF_URL_TEMPLATES" => array(
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_ID#/",
            "rss" => "rss/",
            "rss_section" => "#SECTION_ID#/rss/",
        )
    ),
    false
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>