<?php

namespace App\Services;

use Illuminate\Foundation\Vite;

class ViteService extends Vite
{
    /**
     * Generate a script tag for the given URL.
     *
     * @param  string  $url
     * @return string
     */
    protected function makeScriptTag($url)
    {
        return sprintf('<script type="module" src="%s" defer data-turbolinks-track="reload"></script>', $url);
    }

    /**
     * Generate a stylesheet tag for the given URL in HMR mode.
     *
     * @deprecated Will be removed in a future Laravel version.
     *
     * @param  string  $url
     * @return string
     */
    protected function makeStylesheetTag($url)
    {
        return sprintf('<link  rel="stylesheet" href="%s" data-turbolinks-track="reload" />', $url);
    }
}
