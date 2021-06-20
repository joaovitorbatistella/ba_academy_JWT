<?php

namespace App\Exceptions;

use Exception;

class UserHasBeenTakenException extends Exception
{
    /**
     * HTTP answer to exception
     * @return array
     */
    public function render()
    {
        return response()->json([
            'error'   => class_basename($this),
            'message' => 'User has been taken.',
        ], 400);
    }
}
