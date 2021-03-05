<?php

namespace Koko\Complaints\Controller;

use Koko\Complaints\ComplaintTable;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Config\Option;

class Test extends Controller
{
    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod(array(ActionFilter\HttpMethod::METHOD_POST)),
                ]
            ],
            'count' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(array(ActionFilter\HttpMethod::METHOD_GET)),
                ]
            ],
        ];
    }

    public static function addAction($news_id, $iblock_type_id)
    {
        $errors = array();

        $optionValue = Option::get("koko.complaints", "IBLOCK_TYPE_ID");

        if ($optionValue == $iblock_type_id && $news_id != null) {
            $result = ComplaintTable::add(array(
                'ID' => self::countAction() + 1,
                'ENTITY' => $optionValue,
                'ENTITY_ID' => $news_id,
                'DATETIME' => new DateTime(),
            ));

            if (!$result->isSuccess()) {
                array_push($errors, "Жалоба не отправлена! Ошибка сервера!");
            }
        } else array_push($errors, "Ошибка настройки модуля!");

        return [
            'errors' => $errors,
        ];
    }

    public static function countAction()
    {
        $news = ComplaintTable::getList(array('select' => array('ID')));
        while ($news->Fetch()) {
            $cnt++;
        }
        return $cnt;
    }
}