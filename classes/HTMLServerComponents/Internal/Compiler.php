<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal;

/**
 * HTML Server Components compiler. Converts components code into HTML code.
 */
final class Compiler extends \IvoPetkov\HTMLServerComponentsCompiler
{

    /**
     *
     */
    private static $newComponentCache = null;

    /**
     * Constructs a component object
     * 
     * @param array $attributes The attributes of the component object
     * @param string $innerHTML The innerHTML of the component object
     * @return \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component A component object
     */
    public function constructComponent(array $attributes = [], string $innerHTML = '')
    {
        $app = \BearFramework\App::get();
        if (self::$newComponentCache === null) {
            self::$newComponentCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
        }
        $component = clone(self::$newComponentCache);
        $component->attributes = $attributes;
        $component->innerHTML = $innerHTML;
        $app->hooks->execute('componentCreated', $component);
        return $component;
    }

}
