<?php

namespace Sprobe\Acl\Exceptions;

use Exception;

class ResourceDoesNotExistException extends Exception
{
    /**
     * ActivationTokenNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = 'The resource does not exist.')
    {
        parent::__construct($message);
    }
}
