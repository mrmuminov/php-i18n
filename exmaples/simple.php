<?php

use MrMuminov\PhpI18n\I18n;

require '../vendor/autoload.php';

$i18n = new I18n([
    'languages' => ['en', 'uz'],
    'language' => 'en',
]);

echo $i18n->get('Home');
// Output: "Home"

echo $i18n->get('Hello %s', 'Bahriddin');
// Output: "Hello Bahriddin"

// Set language to uz
$i18n->setLanguage('uz');

echo $i18n->get('Hello %s', 'Bahriddin');
// Output: "Salom Bahriddin"