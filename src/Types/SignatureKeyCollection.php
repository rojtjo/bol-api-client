<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use Rojtjo\Bol\BolException;
use Rojtjo\Bol\Common\TypedCollection;

final class SignatureKeyCollection extends TypedCollection
{
    protected function type(): string
    {
        return SignatureKey::class;
    }

    public static function fromPayload(array $publicKeys): self
    {
        return new self(
            array_map(
                fn (array $signatureKey) => new SignatureKey(
                    $signatureKey['id'],
                    $signatureKey['type'],
                    $signatureKey['publicKey'],
                ),
                $publicKeys['signatureKeys'] ?? [],
            )
        );
    }

    public function byId(string $id): SignatureKey
    {
        return $this->first(
            fn (SignatureKey $signatureKey) => $signatureKey->id === $id,
            fn () => throw new BolException('SignatureKey not found with ID: ' . $id),
        );
    }
}
