# OCR Space API

**Note: still enormously in production!**

This is an API to connect with the [OCR-Space API](https://ocr.space/ocrapi).

## Install

Via Composer

``` bash
$ composer require demeyerthom/php-ocr-space
```

## Usage

``` php
$service = Demeyerthom\OcrSpace\ServiceBuilder::create(
    ['apiKey' => 'helloworld']
)->build;

$request = new Demeyerthom\OcrSpace\Request\ParseImageRequest(__DIR__ . '/path/to/file.jpg');

/** @var Demeyerthom\OcrSpace\Response\ParseImageResponse $response */
$response = $service->handle($request);
```

Note that the Builder also allows a logger to be set (by default a NullLogger is used).

## Roadmap
- Write a better Readme
- Write unittests
- Write Handlers for the url and base64encode methods
- Deal with exceptions when limit has been reached etc

## Testing

``` bash
$ composer test
```

## Contributing

Holler at me!

