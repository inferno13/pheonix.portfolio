<?php

namespace App\Support\Generators;
use App\Models\User;

class TransferAddressGenerator extends CodeGenerator {
  protected static function isUnique($value) {
    return User::whereTransferAddress($value)->count() === 0;
  }

  protected static function generate() {
    return 'PX-' . rand(0, 9) . rand(0, 9) . rand(0, 9) . '-' . rand(0, 9) . rand(0, 9) . rand(0,9);
  }
}
