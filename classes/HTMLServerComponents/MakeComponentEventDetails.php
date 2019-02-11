<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents;

/**
 * @property \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component $component
 */
class MakeComponentEventDetails
{

    use \IvoPetkov\DataObjectTrait;

    /**
     * 
     * @param \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component $component
     */
    public function __construct(\IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component $component)
    {
        $this
                ->defineProperty('component', [
                    'type' => \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component::class
                ])
        ;
        $this->component = $component;
    }

}
