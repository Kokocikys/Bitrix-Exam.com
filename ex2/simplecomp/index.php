<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"custom:simplecomp.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "products",
		"IBLOCK" => "2",
		"SKILLS" => array(
			0 => "Скилл 1",
			1 => "",
		),
		"USER_SECTION_PROP_CODE" => "UF_NEWS_LINK",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"IBLOCK_ID_NEWS" => "1",
		"IBLOCK_ID_CATALOG" => "2",
		"UF_NEWS_LINK" => "UF_NEWS_LINK"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>