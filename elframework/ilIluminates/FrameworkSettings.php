<?php

namespace Iliuminates;

use Iliuminates\Sessions\session;

class FrameworkSettings
{
    /**
     *to set default timezone on mvc
     * @return void
     */
    public static function setTimezone()
    {
        date_default_timezone_set(config('app.timezone'));
    }

    /**
     * to get the current timezone on mvc
     * @return string
     */
    public static function getTimezone()
    {
        return date_default_timezone_get();
    }

    /**
     * get current locale lange
     * @return string
     */
    public static function getLocale()
    {
        return Session::has('locale') ? session::get('locale') : config('app.locale');
    }

    /**
     * change locale lange
     * @param string $locale
     * @return string
     */
    public static function setLocale(string $locale): string
    {
        Session::make('locale', $locale);
        return Session::get('locale');
    }
}
