<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оценка производительности");
?>_____Ex2-11<br>
 <br>
 Самая ресурсоемкая страница –&nbsp;&nbsp;/products/index.php.<br>
 Нагрузка 25.06%, среднее "Страница-Время" – 2.2295 с.<br>
 Проблемный компонент:&nbsp;bitrix:catalog.section.<br>
 Занимает&nbsp;<nobr>0.2015 с и делает з</nobr>апросов: 34<br>
 <br>
 _____Ex2-10<br>
 <br>
 Самая ресурсоемкая страница –&nbsp;&nbsp;<a href="http://bitrix-exam.com/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a><br>
 Нагрузка 23.29%, среднее "Страница-Время" –&nbsp;&nbsp;0.7676 с.<br>
 Проблемный компонент:<br>
 bitrix:catalog.section:&nbsp;<nobr>0.0857 с</nobr>;&nbsp;Запросов: 10 (0.0029 с).<br>
 bitrix:catalog:&nbsp;<nobr>0.0902 с;&nbsp;</nobr>Запросов не совершает.<br>
 + включаемая область /include/news.php:&nbsp;<nobr>0.0914 с.</nobr><br>
 <br>
 _____Ex2-88<br>
 <br>
 Самая ресурсоемкая страница –&nbsp;<a href="http://bitrix-exam.com/bitrix/admin/perfmon_hit_list.php?lang=ru&set_filter=Y&find_script_name=%2Fproducts%2Findex.php">/products/index.php</a><br>
 Нагрузка 26.31%, среднее "Страница-Время" –&nbsp;0.7185&nbsp;с.<br>
 Размер кэша в компоненте&nbsp;custom:simplecomp.exam: 10 КБ. После того, как убрал из занесения в кэш данные, размер кэша не изменился.<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>