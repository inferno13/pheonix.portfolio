<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value'];
    public static function getMethods() {
        return static::all()->pluck('name')->toArray();
    }

    public static function __callstatic($name, $arguments) {
        if (in_array($name, static::getMethods())) {
            return static::whereName($name)->first()->value;
        }
        else {
            return parent::__callStatic($name, $arguments);
        }
    }

    public static function getLevel($level) {
        return (double)static::whereName('level_' . $level)->first()->value;
    }

    public static function getPull($pull) {
        return (double)static::whereName('pull_' . $pull)->first()->value;
    }
}
