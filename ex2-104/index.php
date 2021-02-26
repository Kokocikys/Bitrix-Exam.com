<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Ex2-104");
?>
<?php
\Bitrix\Main\Loader::includeModule("koko.complaints");

use \Koko\Complaints\ComplaintTable;

echo '<pre>';
var_dump(ComplaintTable::getEntity()->compileDbTableStructureDump());
echo '</pre>';

?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>