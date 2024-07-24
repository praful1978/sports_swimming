<?php
$url= "https://github.com/A9T9/OCR.Space-OCR-API-Code-Snippets/tree/3228c9a3849db0f29fc6a178a3e58fb3da690bbd/PHP%20Demo%20Web%20App";
use Mindee\Client;
use Mindee\Product\Passport\PassportV1;

// Init a new client
$mindeeClient = new Client("K85330053088957");

// Load a file from disk
$inputSource = $mindeeClient->sourceFromPath("ocr.txt");

// Parse the file
$apiResponse = $mindeeClient->parse(PassportV1::class, $inputSource);

echo strval($apiResponse->document);