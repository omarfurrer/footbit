<?php

namespace App\Services\Traits;

trait Enumerable {

    public static function all()
    {
        $ref = new \ReflectionClass(__CLASS__);

        return $ref->getConstants();
    }

    public static function lists()
    {
        $constants = self::all();

        $results = [];

        foreach ($constants as $key => $value) {
            $exploded = explode("_", $key);
            $results[$value] = implode(' ', $exploded);
        }
        return $results;
    }

    public static function values()
    {
        $ref = new \ReflectionClass(__CLASS__);

        return array_values($ref->getConstants());
    }

    public static function StringKeyByvalue($val)
    {
        $key = self::keyByValue($val);
        $exploded = explode("_", $key);
        $results = implode(' ', $exploded);
        return $results;
    }

    public static function keyByValue($val)
    {
        $ref = new \ReflectionClass(__CLASS__);

        foreach ($ref->getConstants() as $key => $value) {
            if ($value == $val) {
                return $key;
            }
        }
    }

    public static function valueByStringKey($key)
    {
        return constant(__CLASS__ . '::' . $key);
    }

}
