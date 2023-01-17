<?php
declare(strict_types=1);

namespace Shippii\Resources;

use Shippii\Shippii;
use Shippii\Actions\WebhookSignature;
use Shippii\Exceptions\FailedActionException;

class Webhook
{
    public static function constructEvent(Shippii $shippii, mixed $payload, string $headerSignature, string $secret)
    {
        WebhookSignature::verifyHeader($payload, $headerSignature, $secret);

        $payloadArr = \json_decode($payload, true);

        $jsonError = \json_last_error();

        if ($payloadArr === null && \JSON_ERROR_NONE !== $jsonError) {
            $msg = "Invalid payload: {$payload} "
                . "(json_last_error() was {$jsonError})";

            throw new FailedActionException($msg);
        }
        
        return Event::constructFrom($payloadArr, $shippii);
    }
}