<?php

require '../vendor/autoload.php';

$i18n = new \MrMuminov\PhpI18n\I18n([
    'languages' => ['en', 'uz'],
    'language' => 'en',
]);

echo $i18n->get('Home');
// Output: "Home"

echo $i18n->get('Hello %s', 'John');
// Output: "Hello John"