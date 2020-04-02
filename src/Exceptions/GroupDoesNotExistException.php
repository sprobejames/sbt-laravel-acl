<?php

namespace Sprobe\Acl\Exceptions;

use Exception;

class GroupDoesNotExistException extends Exception
{
    /**
     * ActivationTokenNotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = 'The group does not exist.')
    {
        parent::__construct($message);
    }
}
