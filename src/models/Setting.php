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
    const TYPE_INT = 2;
    const TYPE_FLOAT = 3;
    const TYPE_BOOL = 4;

    public static function getTypes()
    {
        return [
            self::TYPE_TEXT => 'TEXT',
            self::TYPE_JSON => 'JSON',
            self::TYPE_INT => 'INT',
            self::TYPE_FLOAT => 'FLOAT',
            self::TYPE_BOOL => 'BOOL',
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

            case self::TYPE_INT:
                $result = intval($this->value);
                break;

            case self::TYPE_FLOAT:
                $result = floatval($this->value);
                break;

            case self::TYPE_BOOL:
                $result = boolval($this->value);
                break;

            case self::TYPE_TEXT:
            default:
                $result = $this->value;
                break;
        }

        return $result;
    }
}