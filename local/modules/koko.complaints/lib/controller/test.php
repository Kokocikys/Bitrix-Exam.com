<?php

namespace Koko\Complaints\Lib\Controller;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;

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

    public static function addAction()
    {
        //код...
        return [
            'ENTITY' => $arFields["ENTITY"],
            'ENTITY_ID' => $arFields["ENTITY_ID"],
            'DATETIME' => $arFields["DATETIME"],
        ];
    }

    public static function countAction()
    {
        return $num = 0;
    }
}