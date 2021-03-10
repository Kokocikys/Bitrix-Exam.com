<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"custom:simplecomp.exam", 
	".default", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"IBLOCK" => "2",
		"IBLOCK_ID_CATALOG" => "2",
		"IBLOCK_ID_NEWS" => "1",
		"IBLOCK_TYPE" => "products",
		"SKILLS" => array(
			0 => "Скилл 1",
			1 => "",
		),
		"UF_NEWS_LINK" => "UF_NEWS_LINK",
		"USER_SECTION_PROP_CODE" => "UF_NEWS_LINK",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>