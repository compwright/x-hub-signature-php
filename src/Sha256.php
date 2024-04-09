<?php

declare(strict_types=1);

namespace Compwright\XHubSignature;

class Sha256 implements SignerInterface
{
    use VerifyTrait;

    public const ALGO = 'sha256';

    public function sign(string $body, string $secret): string
    {
        return self::ALGO . '=' . hash_hmac(self::ALGO, $body, $secret, false);
    }

    public function getHeaderName(): string
    {
        return 'X-Hub-Signature-256';
    }
}
