<?php

namespace App\Exceptions;

use Exception;

class UserNotAllowedException extends Exception
{
    /**
     * HTTP answer to exception
     * @return array
     */
    public function render()
    {
        return response()->json([
            'error'   => class_basename($this),
            'message' => 'User is not allowed to do this action.',
        ], 400);
    }
}
