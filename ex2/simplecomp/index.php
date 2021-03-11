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
		"USER_PROPERTY" => "UF_AUTHOR_TYPE"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>