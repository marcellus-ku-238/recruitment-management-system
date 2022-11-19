<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;

class CustomException extends Exception
{
    use ApiResponser;

    protected $message;
    protected $code;
    
    public function __construct($message, $code = 400)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function render()
    {
        return $this->error([
            'message' => $this->message
        ], $this->code);
    }
}
