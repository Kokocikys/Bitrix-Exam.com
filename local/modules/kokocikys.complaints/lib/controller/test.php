<?php

namespace Local\Complaints\Lib\Controller;

use Bitrix\Main\ORM\Data\DataManager;

class ComplaintsTable extends DataManager
{
    public static function getTableName()
    {
        return 'news_complaints';
    }

    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => "ID",
            ),
            'ENTITY' => array(
                'data_type' => 'string',
                'required' => true,
                'title' => "ENTITY",
            ),
            'ENTITY_ID' => array(
                'data_type' => 'integer',
                'required' => true,
                'title' => "ENTITY_ID",
            ),
            'DATETIME' => array(
                'data_type' => 'datetime',
                'required' => true,
                'title' => "DATETIME",
            ),
        );
    }
}