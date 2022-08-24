<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Secure;

use Webmozart\Assert\Assert;

final class SignatureHeader
{
    public function __construct(
        public string $keyId,
        public string $algorithm,
        public string $signature,
    )
    {
    }

    public static function parse(string $input): self
    {
        // Example input
        // keyId=0, algorithm="rsa-sha256", signature=SomeRandomSignatureEndingIn==

        $input = str_replace('"', '', $input);
        $pairs = explode(', ', $input);

        $values = [];
        foreach ($pairs as $pair) {
            [$key, $value] = explode('=', $pair, 2);
            $values[$key] = $value;
        }


        Assert::notNull($values['keyId'] ?? null, 'KeyId cannot be null');
        Assert::notNull($values['algorithm'] ?? null, 'Algorithm cannot be null');
        Assert::notNull($values['signature'] ?? null, 'Signature cannot be null');

        return new self($values['keyId'], $values['algorithm'], $values['signature']);
    }
}
