<?php

declare(strict_types=1);

namespace Compwright\XHubSignature;

interface SignerInterface
{
    public function sign(string $body, string $secret): string;

    public function getHeaderName(): string;

    public function verify(string $expectedSignature, string $body, string $secret): bool;
}
