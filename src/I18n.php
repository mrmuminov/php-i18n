<?php

namespace MrMuminov\PhpI18n;

/**
 * I18n class
 * @author Bahriddin Muminov
 * @version 1.0
 * @created 04-May-2016 12:00:00 PM
 *
 * @property string $lang Current language
 * @property string $path Language messages path
 */
class I18n
{
    /**
     * @var string|null
     */
    private $lang;
    /**
     * @var string|null
     */
    private $path = __DIR__ . '../messages';
    /**
     * @var array
     */
    private $_locale = [];

    /**
     * @param $lang string
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
        $this->include();
    }

    /**
     * @param $text string
     * @param ...$args array
     * @return string
     */
    public function get($text, ...$args)
    {
        $text = $this->getLocale($this->getLang(), $text);
        return vsprintf($text, $args);
    }

    /**
     * @return void
     */
    private function include()
    {
        $lang = $this->getLang();
        $file = $this->path . "/$lang.php";
        if (file_exists($file)) {
            $this->setLocale(include_once $file);
        }
    }

    /**
     * @return string|null
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param $lang string
     * @return void
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @param $lang string
     * @param $text string
     * @return mixed|null
     */
    public function getLocale($lang, $text)
    {
        return $this->_locale[$lang][$text] ?? null;
    }

    /**
     * @param $source array
     * @return void
     */
    public function setLocale($source)
    {
        $lang = $this->getLang();
        if (!isset($this->_locale[$lang])) {
            $this->_locale[$lang] = $source;
        }
    }
}