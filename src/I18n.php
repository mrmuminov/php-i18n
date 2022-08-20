<?php

namespace MrMuminov\PhpI18n;

/**
 * I18n class
 * @author Bahriddin Muminov
 * @version 1.0
 * @created 04-May-2016 12:00:00 PM
 */
class I18n
{
    /**
     * @var array
     */
    private $languages;
    /**
     * @var string
     */
    private $language;
    /**
     * @var string
     */
    private $path = __DIR__ . '/../messages';
    /**
     * @var array
     */
    private $_locale = [];

    public function __construct(array $config)
    {
        if (isset($config['path'])) {
            $this->setPath($config['path']);
        }
        if (isset($config['languages'])) {
            $this->setLanguages($config['languages']);
        }
        if (isset($config['language'])) {
            $this->setLanguage($config['language']);
        }
    }

    private function setPath(string $path)
    {
        $this->path = $path;
    }

    private function setLanguages(array $languages)
    {
        $this->languages = $languages;
    }

    public function get(string $text, ...$args): string
    {
        $text = $this->getLocale($text);
        return vsprintf($text, $args);
    }

    private function getLocale(string $text): string
    {
        $lang = $this->getLanguage();
        return $this->_locale[$lang][$text] ?? '';
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language)
    {
        $this->language = $this->isInLanguages($language) ? $language : $this->getFirstLanguage();
        $this->include();
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @param $language string
     * @return bool
     */
    private function isInLanguages(string $language): bool
    {
        return in_array($language, $this->getLanguages());
    }

    /**
     * @return string
     */
    private function getFirstLanguage(): string
    {
        $languages = $this->getLanguages();
        if (isset($languages[0])) {
            return $languages[0];
        }
        return '';
    }

    /**
     * @return void
     */
    private function include()
    {
        $lang = $this->getLanguage();
        $file = $this->getPath() . "/$lang.php";
        if (file_exists($file)) {
            $included = include $file;
            $this->setLocale($included);
        }
    }

    private function getPath(): string
    {
        return $this->path ?? '';
    }

    private function setLocale(array $source)
    {
        $lang = $this->getLanguage();
        if (!isset($this->_locale[$lang])) {
            $this->_locale[$lang] = $source;
        }
    }
}