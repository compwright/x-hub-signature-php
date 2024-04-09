# X-Hub-Signature tools for PHP

[![Sponsor on GitHub](https://img.shields.io/static/v1?label=Sponsor&message=❤&logo=GitHub&link=https://github.com/sponsors/compwright)](https://github.com/sponsors/compwright)

X-Hub-Signature is a compact way to validate webhooks from [Facebook](https://developers.facebook.com/docs/graph-api/webhooks/), [GitHub](https://developer.github.com/webhooks/securing/), or any other source that uses this signature scheme.

Care has been taken to avoid security issues, including timing attacks.

## Getting Started

To install:

```shell
composer require compwright/x-hub-signature
```

## Usage

Sign a buffer containing a request body:

```php
<?php

use Compwright\XHubSignature;
use InvalidArgumentException;

$signer = new XHubSignature\Sha256();

// Generate the signature header for an outbound webhook, i.e.
//
//   X-Hub-Signature-256: sha256=...
//
$headerName = $signer->getHeaderName();
$headerValue = $signer->sign($requestBody, $secret);
$signatureHeader = $headerName . ': ' . $headerValue;

// Verify an inbound webhook
$isValid = $signer->verify($signatureHeaderValue, $requestBody, $secret);
if ($isValid === false) {
    throw new InvalidArgumentException('Bad Request');
}
```

## License

MIT License
