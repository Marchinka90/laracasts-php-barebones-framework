<?php

namespace Core;

class ValidationException extends \Exception
{
  public readonly array $errors;
  public readonly array $old;

  public static function throw($errors, $old)
  {
    $instace = new static;
    $instace->errors = $errors;
    $instace->old = $old;
    
    throw $instace;
  }

}