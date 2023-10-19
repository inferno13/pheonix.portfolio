<?php

namespace App\Traits;

trait CanGetTableNameStatically
{
    public static function tableName()
    {
        return with(new static)->getTable();
    }
}