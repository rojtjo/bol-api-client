<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use PHPUnit\Framework\TestCase;

final class SignatureHeaderTest extends TestCase
{
    /** @test */
    public function parse_signature_header(): void
    {
        $header = 'keyId=0, algorithm="rsa-sha256", signature=SomeRandomSignatureEndingIn==';

        $signatureHeader = SignatureHeader::parse($header);

        $this->assertSame('0', $signatureHeader->keyId);
        $this->assertSame('rsa-sha256', $signatureHeader->algorithm);
        $this->assertSame('SomeRandomSignatureEndingIn==', $signatureHeader->signature);
    }
}
