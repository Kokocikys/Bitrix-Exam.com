<?php

namespace Koko\Complaints\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;

class Test extends Controller
{
    public function configureActions()
    {
        return [
            'example' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod(array(ActionFilter\HttpMethod::METHOD_POST)),
                ]
            ]
        ];
    }

    public static function addAction(array $arFields)
    {
        return [
            'ENTITY' => $arFields["ENTITY"],
            'ENTITY_ID' => $arFields["ENTITY_ID"],
            'DATETIME' => $arFields["DATETIME"],
        ];
    }

    public static function countAction()
    {
        // тут считаем количество строк таблицы
        return $num = 0;
    }
}