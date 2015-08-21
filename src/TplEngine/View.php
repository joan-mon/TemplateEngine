<?php

namespace jmon\TplEngine;

class View
{
    /**
     * @var string
     */
    private static $basePath = '';
    /**
     * @var array
     */
    private static $templateHeap = [];
    /**
     * @var string
     */
    private static $contentToRender = '';
    /**
     * @var array
     */
    private static $vars = [];

    /**
     * Base path of templates directory
     * @param string $basePath
     */
    public static function setBasePath($basePath)
    {
        self::$basePath = realpath($basePath);
    }

    /**
     * Template which wil be extended
     * @param string $template
     */
    public static function templateExtend($template)
    {
        array_push(self::$templateHeap, $template);
    }

    /**
     * Template rendering
     * @param $template
     *
     * @return string
     */
    public static function render($template)
    {
        $templateContent = self::requireIntoString($template);
        while (!empty(self::$templateHeap)) {
            self::$contentToRender = $templateContent;
            $templateContent = self::requireIntoString(array_pop(self::$templateHeap));
        }
        return $templateContent;
    }

    /**
     * Used to print some content into layout.
     */
    public static function content()
    {
        echo self::$contentToRender;
    }

    /**
     * It saves variable into template engine.
     * @param string     $name
     * @param string|int $value
     */
    public static function set($name, $value)
    {
        self::$vars[$name] = $value;
    }

    /**
     * It gets one variable saved previously.
     * @param string $name
     *
     * @return mixed
     */
    public static function get($name)
    {
        return isset(self::$vars[$name]) ? self::$vars[$name] : null;
    }

    /**
     * It prints one variable saved previously.
     * @param string $name
     */
    public static function printVar($name)
    {
        echo isset(self::$vars[$name]) ? self::$vars[$name] : '';
    }

    /**
     * It dumps a partial template into another one.
     * @param string $partial
     */
    public static function partial($partial)
    {
        echo self::requireIntoString($partial);
    }

    /**
     * @param $template
     *
     * @return string
     */
    private static function requireIntoString($template)
    {
        ob_start();
        require self::$basePath.DIRECTORY_SEPARATOR.$template;

        return ob_get_clean();
    }
}
