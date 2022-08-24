<?php

declare(strict_types=1);

namespace Rojtjo\Bol;

use Psr\Http\Message\ResponseInterface;
use Rojtjo\Bol\Types\Problem;
use Rojtjo\Bol\Util\ResponseUtil;
use RuntimeException;

final class BolException extends RuntimeException
{
    public ?ResponseInterface $response;
    public ?Problem $problem;

    public static function fromResponse(ResponseInterface $response): self
    {
        $message = sprintf(
            "Request failed with status: %s\n%s",
            $response->getStatusCode(),
            ResponseUtil::readBody($response),
        );

        $instance = new self($message);
        $instance->response = $response;

        try {
            $data = ResponseUtil::decodeJson($response);
            $instance->problem = Problem::fromPayload($data);
        } finally {
            return $instance;
        }
    }
}
