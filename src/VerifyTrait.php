<?php

declare(strict_types=1);

namespace Compwright\XHubSignature;

trait VerifyTrait
{
    public function verify(string $expectedSignature, string $body, string $secret): bool
    {
        $actualSignature = $this->sign($body, $secret);
        return hash_equals($actualSignature, $expectedSignature);
    }
}
