<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal;

/**
 * HTML Server Components compiler. Converts components code into HTML code.
 */
final class Compiler extends \IvoPetkov\HTMLServerComponentsCompiler
{

    /**
     * Constructs a component object
     * 
     * @param array $attributes The attributes of the component object
     * @param string $innerHTML The innerHTML of the component object
     * @return \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component A component object
     * @throws \InvalidArgumentException
     */
    public function constructComponent($attributes = [], $innerHTML = '')
    {
        if (!is_array($attributes)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($innerHTML)) {
            throw new \InvalidArgumentException('');
        }
        $app = \BearFramework\App::get();
        $component = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
        $component->attributes = $attributes;
        $component->innerHTML = $innerHTML;
        $app->hooks->execute('componentCreated', $component);
        return $component;
    }

}
