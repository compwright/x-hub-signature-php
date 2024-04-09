<?php

namespace Compwright\XHubSignature;

use PHPUnit\Framework\TestCase;

class Sha256Test extends TestCase
{
    public function testSign(): void
    {
        $expected = 'sha256=2bee603b1bd2b873912ee43469a3b4a377ad70e7f64cbd58ccdbc67eb9a1b37f';
        $secret = 'my_little_secret';
        $body = '{ "id": "realtime_update" }';
        $signer = new Sha256();
        $actual = $signer->sign($body, $secret);
        $this->assertSame($expected, $actual);
    }

    public function testSignUtf8(): void
    {
        $expected = 'sha256=c550bad604a0dbdc116bfdc1a136fe91a12c9b90393e4a7d6592c976302e98cd';
        $secret = 'my_little_secret';
        $body = 'random-utf-8-あいうえお-body';
        $signer = new Sha256();
        $actual = $signer->sign($body, $secret);
        $this->assertSame($expected, $actual);
    }

    public function testVerify(): void
    {
        $secret = 'my_little_secret';
        $body = '{ "id": "realtime_update" }';
        $signature = 'sha256=2bee603b1bd2b873912ee43469a3b4a377ad70e7f64cbd58ccdbc67eb9a1b37f';
        $signer = new Sha256();
        $this->assertTrue($signer->verify($signature, $body, $secret));
        $this->assertFalse($signer->verify($signature, $body . '-foo', $secret));
        $this->assertFalse($signer->verify($signature, $body, 'foo'));
        $this->assertFalse($signer->verify('', $body, $secret));
    }
}
