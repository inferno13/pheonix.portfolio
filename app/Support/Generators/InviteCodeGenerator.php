<?php

namespace App\Support\Generators;
use Illuminate\Support\Str;
use App\Models\User;

class InviteCodeGenerator extends CodeGenerator {
  protected static function isUnique($value) {
    return User::whereInviteCode($value)->count() === 0;
  }

  protected static function generate() {
    return Str::random(8);
  }
}
