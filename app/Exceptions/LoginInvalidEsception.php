<?php

namespace App\Exceptions;

use Exception;

class LoginInvalidEsception extends Exception
{
    /**
     * HTTP answer to exception
     * @return array
     */
    public function render()
    {
        return response()->json([
            'error'   => class_basename($this),
            'message' => 'Email and password don\'t match.',
        ], 400);
    }
}
