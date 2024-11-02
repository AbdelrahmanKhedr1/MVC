<?php

namespace Iliuminates\Views;

class View
{
    protected static $cachDir;

    /**
     * @return void
     */
    public static function prepare_cache()
    {
        static::$cachDir = config('view.cache_dir');
        if (!is_dir(static::$cachDir)) {
            mkdir(static::$cachDir, 0755, true);
        }
    }

    /**
     * @param mixed $view
     * @param null|array $data
     * @return mixed
     */
    public static function make($view, null|array $data = null)
    {
        if (config('view.cache')) {
            static::prepare_cache();
            $cache_file = static::getCacheFilePath($view);
            if (static::isCacheValid($cache_file)) {
                include $cache_file;
            } else {
                $output = static::generateViewOutput($view, $data);
                file_put_contents(static::getCacheFilePath($view), $output);
                return $output;
            }
        } else {
            $view = str_replace('.', '/', $view);
            $path = config('view.path');
            !is_null($data)?extract($data):'';
            include $path . '/' . $view . '.tpl.php';
        }
    }

    /**
     * @param mixed $view
     * @return string
     */
    protected static function getCacheFilePath($view):string
    {
        return static::$cachDir . '/' . md5(config('view.path') . '_' . $view) . '.cache.php';
    }

    /**
     * @param mixed $file
     * @return boolean
     */
    protected static function isCacheValid($file):bool
    {
        return file_exists($file);
    }

    /**
     * @param mixed $view
     * @param mixed $data
     * @return mixed
     */
    protected static function generateViewOutput($view, $data = null)
    {
        $view = str_replace('.', '/', $view);
        $path = config('view.path');
        !is_null($data)?extract($data):'';
        ob_start();
        include $path . '/' . $view . '.tpl.php';
        return ob_get_clean();
    }
}
