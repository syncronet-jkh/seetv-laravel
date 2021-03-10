<?php

namespace App;

use Illuminate\Support\Str;
use function substr;

class Initials
{
  public static function make(string $username)
  {
    return Str::of($username)
      ->snake(' ')
      ->title()
      ->explode(' ')
      ->map(fn ($str) => substr($str, 0, 1))
      ->join('');
  }
}
