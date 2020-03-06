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
     *
     */
    private static $newMakeComponentEventDetailsCache = null;

    /**
     * 
     * @var \IvoPetkov\BearFramework\Addons\HTMLServerComponents
     */
    private $components = null;

    /**
     * 
     * @param \IvoPetkov\BearFramework\Addons\HTMLServerComponents $components
     */
    public function __construct(\IvoPetkov\BearFramework\Addons\HTMLServerComponents $components)
    {
        $this->components = $components;
    }

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
        if (self::$newComponentCache === null) {
            self::$newComponentCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
        }
        $component = clone (self::$newComponentCache);
        $component->setAttributes($attributes);
        $component->innerHTML = $innerHTML;
        $component->tagName = $tagName;
        if ($this->components->hasEventListeners('makeComponent')) {
            if (self::$newMakeComponentEventDetailsCache === null) {
                self::$newMakeComponentEventDetailsCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\MakeComponentEventDetails();
            }
            $details = clone (self::$newMakeComponentEventDetailsCache);
            $details->component = $component;
            $this->components->dispatchEvent('makeComponent', $details);
        }
        return $component;
    }
}
