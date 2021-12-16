<?php

namespace MrMuminov\PhpI18n;

use Exception;

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
     * @var string|null
     */
    private $language;
    /**
     * @var string|null
     */
    private $path = __DIR__ . '/../messages';
    /**
     * @var array
     */
    private $_locale = [];

    /**
     * @param $config array
     * @throws Exception
     */
    public function __construct(array $config)
    {
        if (isset($config['languages'])) {
            $this->setLanguages($config['languages']);
        }
        if (isset($config['language'])) {
            if ($this->isInLanguages($config['language'])) {
                $this->setLanguage($config['language']);
            } else {
                $this->setLanguage($this->getFirstLanguage());
            }
        }
        if (isset($config['path'])) {
            $this->path = $config['path'];
        }
        $this->include();
    }

    /**
     * @param array $languages
     */
    private function setLanguages(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param $language
     * @return bool
     */
    private function isInLanguages($language): bool
    {
        return in_array($language, $this->getLanguages());
    }

    /**
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function getFirstLanguage()
    {
        $languages = $this->getLanguages();
        if (isset($languages[0])) {
            return $languages[0];
        }
        throw new Exception('No languages found');
    }

    /**
     * @return void
     */
    private function include()
    {
        $lang = $this->getLanguage();
        $file = $this->path . "/$lang.php";
        if (file_exists($file)) {
            $included = include $file;
            $this->setLocale($included);
        }
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param $language string
     * @return void
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
        $this->include();
    }

    /**
     * @param $source array
     * @return void
     */
    private function setLocale(array $source)
    {
        $lang = $this->getLanguage();
        if (!isset($this->_locale[$lang])) {
            $this->_locale[$lang] = $source;
        }
    }

    /**
     * @param $text string
     * @param $args
     * @return string
     */
    public function get(string $text, ...$args): string
    {
        $text = $this->getLocale($text);
        return vsprintf($text, $args);
    }

    /**
     * @param string $text
     * @return mixed|null
     */
    private function getLocale(string $text)
    {
        $lang = $this->getLanguage();
        return $this->_locale[$lang][$text] ?? null;
    }

    /**
     * @return string|null
     */
    private function getPath()
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     */
    private function setPath(string $path)
    {
        $this->path = $path;
    }
}