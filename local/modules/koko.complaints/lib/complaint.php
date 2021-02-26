<?php

namespace Koko\Complaints;

use Bitrix\Main\Entity;

class ComplaintTable extends Entity\DataManager
{
    public static function getUfId()
    {
        return 'NEWS_COMPLAINTS';
    }

    public static function getTableName()
    {
        return 'news_complaints';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
                'column_name' => "ID",
            )),
            new Entity\StringField('ENTITY', array(
                'required' => true,
                'column_name' => "ENTITY",
            )),
            new Entity\IntegerField('ENTITY_ID', array(
                'required' => true,
                'column_name' => "ENTITY_ID",
            )),
            new Entity\DatetimeField('DATETIME', array(
                'required' => true,
                'column_name' => "DATETIME",
            )),
        );
    }
}