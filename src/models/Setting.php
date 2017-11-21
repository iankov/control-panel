<?php

namespace Iankov\ControlPanel\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['name', 'type', 'key', 'value', 'active'];

    public $timestamps = true;

    const TYPE_TEXT = 0;
    const TYPE_JSON = 1;

    public static function getTypes()
    {
        return [
            Setting::TYPE_TEXT => 'Text',
            Setting::TYPE_JSON => 'Json'
        ];
    }

    public function getTypeNameAttribute()
    {
        return self::getTypes()[$this->type];
    }

    public function getParsedValueAttribute()
    {
        switch($this->type){
            case self::TYPE_JSON:
                $result = json_decode($this->value);
                break;

            case self::TYPE_TEXT:
            default:
                $result = $this->value;
                break;
        }

        return $result;
    }
}