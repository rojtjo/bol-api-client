<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

final class SignatureKey
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $publicKey,
    )
    {
    }

    public function verify(string $payload, string $algorithm, string $signature): bool
    {
        $result = openssl_verify(
            $payload,
            base64_decode($signature),
            $this->pem(),
            $algorithm,
        );

        return $result === 1;
    }

    private function pem(): string
    {
        return <<<PEM
        -----BEGIN PUBLIC KEY-----
        $this->publicKey
        -----END PUBLIC KEY-----
        PEM;
    }
}
