<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal;

use BearFramework\App;

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
     * @param string $tagName The tag name of the component object
     * @return \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component A component object
     */
    public function makeComponent(array $attributes = [], string $innerHTML = '', string $tagName = 'component')
    {
        $app = App::get();
        if (self::$newComponentCache === null) {
            self::$newComponentCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
        }
        $component = clone(self::$newComponentCache);
        foreach ($attributes as $name => $value) {
            $component->setAttribute($name, $value);
        }
        $component->innerHTML = $innerHTML;
        $component->tagName = $tagName;
        if ($app->components->hasEventListeners('makeComponent')) {
            $app->components->dispatchEvent('makeComponent', new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\MakeComponentEventDetails($component));
        }
        return $component;
    }

}
