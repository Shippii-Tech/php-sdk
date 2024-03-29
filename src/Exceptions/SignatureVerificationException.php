<?php
declare(strict_types=1);

namespace Shippii\Exceptions;

use Exception;

class SignatureVerificationException extends Exception
{

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}