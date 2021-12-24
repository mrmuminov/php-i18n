# PHP-I18N
[![Latest Stable Version](http://poser.pugx.org/mrmuminov/php-i18n/v)](https://packagist.org/packages/mrmuminov/php-i18n)
[![Total Downloads](http://poser.pugx.org/mrmuminov/php-i18n/downloads)](https://packagist.org/packages/mrmuminov/php-i18n)
![](https://api.codiga.io/project/30445/score/svg)
![](https://api.codiga.io/project/30445/status/svg)
![](https://scrutinizer-ci.com/g/MrMuminov/php-i18n/badges/quality-score.png?b=master)
[![License](http://poser.pugx.org/mrmuminov/php-i18n/license)](https://packagist.org/packages/mrmuminov/php-i18n)
![](https://scrutinizer-ci.com/g/MrMuminov/php-i18n/badges/build.png?b=master)
![](https://scrutinizer-ci.com/g/MrMuminov/php-i18n/badges/code-intelligence.svg?b=master)
#### A PHP library for internationalization

---
### Installation
```shell
composer require mrmuminov/php-i18n
```
or add the following to your `composer.json`:
```json
{
  "require": {
    "mrmuminov/php-i18n": "^v1.0"
  }
}
```

---

### Usage
```php
<?php

require '../vendor/autoload.php';

$i18n = new \MrMuminov\PhpI18n\I18n([
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
```


---

### Author
- [Bahriddin Mo'minov](https://github.com/mrmuminov)

