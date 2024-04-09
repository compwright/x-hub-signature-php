<?php

namespace Compwright\XHubSignature;

use PHPUnit\Framework\TestCase;

class Sha1Test extends TestCase
{
    public function testSign(): void
    {
        $expected = 'sha1=3dca279e731c97c38e3019a075dee9ebbd0a99f0';
        $secret = 'my_little_secret';
        $body = 'random-signature-body';
        $signer = new Sha1();
        $actual = $signer->sign($body, $secret);
        $this->assertSame($expected, $actual);
    }

    public function testSignUtf8(): void
    {
        $expected = 'sha1=6eca52592dced2ec4b9c974538d6bb32e25ab897';
        $secret = 'my_little_secret';
        $body = 'random-utf-8-あいうえお-body';
        $signer = new Sha1();
        $actual = $signer->sign($body, $secret);
        $this->assertSame($expected, $actual);
    }

    public function testVerify(): void
    {
        $secret = 'my_little_secret';
        $body = 'random-signature-body';
        $signature = 'sha1=3dca279e731c97c38e3019a075dee9ebbd0a99f0';
        $signer = new Sha1();
        $this->assertTrue($signer->verify($signature, $body, $secret));
        $this->assertFalse($signer->verify($signature, $body . '-foo', $secret));
        $this->assertFalse($signer->verify($signature, $body, 'foo'));
    }
}
