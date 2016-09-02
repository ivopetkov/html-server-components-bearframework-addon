<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents;

/**
 * Process HTML code and transforms component tags
 */
class Compiler extends \IvoPetkov\HTMLServerComponentsCompiler
{

    /**
     * Constructs a Component object
     * @param array $attributes The attributes of the component tag
     * @param string $innerHTML The innerHTML of the component tag
     * @return \BearFramework\App\Component A component object
     */
    protected function constructComponent($attributes = [], $innerHTML = '')
    {
        $app = \BearFramework\App::$instance;
        $component = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component();
        $component->attributes = $attributes;
        $component->innerHTML = $innerHTML;
        $app->hooks->execute('componentCreated', $component);
        return $component;
    }

    /**
     * Includes the component file providing context information
     * @param string $file
     * @param array $variables
     * @throws \Exception
     * @return string
     */
    protected function getComponentFileContent($file, $variables)
    {
        $app = \BearFramework\App::$instance;
        $variables['app'] = $app;
        $context = $app->getContext($file);
        $variables['context'] = $context;
        return parent::getComponentFileContent($file, $variables);
    }

}
