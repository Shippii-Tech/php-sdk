<?php
declare(strict_types=1);

namespace Shippii\Actions;

use Shippii\Exceptions\SignatureVerificationException;

abstract class WebhookSignature
{
    public static function verifyHeader(string $payload, string $headerSignature, string $secret)
    {
        if (empty($headerSignature)) {
            throw new SignatureVerificationException("No signatures found.");
        }

        $expectedSignature = self::verifySignature($payload, $secret, $headerSignature);

        if (!$expectedSignature) {
            throw new SignatureVerificationException('No signatures found matching the expeced signature for payload.');
        }
    }

    private static function verifySignature($payload, $secret, $signature)
    {
        return \hash_hmac('sha256', $payload, $secret) === $signature;
    }
}
