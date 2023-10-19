<?php

namespace App\Support\Generators;

abstract class CodeGenerator {
  abstract protected static function generate();
  abstract protected static function isUnique($value);
  public static function get() {
    $result = static::generate();
    if (static::isUnique($result)) {
      return $result;
    }
    return static::get();
  }
}
