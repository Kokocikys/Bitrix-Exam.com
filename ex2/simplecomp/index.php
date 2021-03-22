<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости по интересам");
?><?$APPLICATION->IncludeComponent(
	"custom:simplecomp.exam", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ID" => "1",
		"NEWS_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"USER_PROPERTY" => "UF_AUTHOR_TYPE",
		"IBLOCK_ID_CATALOG" => "2",
		"IBLOCK_ID_NEWS" => "2",
		"USER_SECTION_PROP_CODE" => "UF_NEWS_LINK",
		"FIRM" => "FIRM",
		"IBLOCK_ID_CLASS" => "6",
		"IBLOCK_ID_CLASSIFIER" => "5",
		"USER_CODE" => "FIRM"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>