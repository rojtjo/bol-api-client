<?php

declare(strict_types=1);

namespace Rojtjo\Bol\Types;

use PHPUnit\Framework\TestCase;

final class SignatureKeyTest extends TestCase
{
    /** @test */
    public function verify_signature(): void
    {
        $signatureKey = new SignatureKey(
            '1',
            'RSA',
            'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAh5x6f/IexlWgo23VF9yH7zmRWEaFShAXyFoR3Flh0ZwSn8hZY+rR3zJt/FWKT6mcw51cFjNWGoi92FLLCsXq49TS+8T6z5/AqpS/cORzFndiaPeMN5k9nla9ECwWqizqoBWRFyg7tnP0GkbZF+rjLlAbUznisEItGcfu9rw4+CfulFTwA9CGxKUDNJOcihEkUflsMlGL2Stqs1Q54O2GTPlLX4KTn1z7Iy4E8IqSOm9Z7sEFHK/RR7sf6K3JsN/h3nR0+NN8o2OGCZ1z17OjSnWXbq1QDZIkN+PntEIW540Og0SHDshLAGxOeW0jw8tU/uKZMhR7lmmrabLjutk3NQIDAQAB',
        );

        $signature = 'ae2Z1c36OxpTu7OiljUJMqbW5I2+aqU04xO3Z5eInL73vvXuWwXOIEaVDpmyfXAz7HhaFJ6q73qKqHhE9zP1BEyp/CyRC+3EPU9QauUk6GS66FWS9EFPhvuC/hj0z6xwRXaMMu6J/p89rb3utsO4nagT1iuFNdAz4mRPg3UnyIl50oSWyC99zje090cxNUGw7f3WY8gvTt9bGhiAQ8gMQgA2dw++UTov3r+ifdAaj7cMLEHS5gT7mn4Cqo8kYLejRab81l9Zge0q0ozX2/4OUaEXjemo/+w6QFJrq1Vsih+PFrU7BzzyUs8m+CVUdpSsXZQTiragTKs9ZIrnpmS9mA==';
        $payload = '{"retailerId":1659925,"timeStamp":"2021-11-18T16:37:13+01:00","event":{"resource":"PROCESS_STATUS","type":"SUCCESS","resourceId":"33371690441","metadata":{},"links":[]}}';

        $valid = $signatureKey->verify($payload, 'rsa-sha256', $signature);

        $this->assertTrue($valid);
    }
}
