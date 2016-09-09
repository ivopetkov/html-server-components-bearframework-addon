<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons\HTMLServerComponents;

/**
 * HTML Server Components compiler. Converts components code into HTML code.
 */
class Compiler extends \IvoPetkov\HTMLServerComponentsCompiler
{

    /**
     * Constructs a component object
     * 
     * @param array $attributes The attributes of the component object
     * @param string $innerHTML The innerHTML of the component object
     * @return \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component A component object
     * @throws \InvalidArgumentException
     */
    protected function constructComponent($attributes = [], $innerHTML = '')
    {
        if (!is_array($attributes)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($innerHTML)) {
            throw new \InvalidArgumentException('');
        }
        $app = \BearFramework\App::$instance;
        $component = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component();
        $component->attributes = $attributes;
        $component->innerHTML = $innerHTML;
        $app->hooks->execute('componentCreated', $component);
        return $component;
    }

    /**
     * Includes a component file and returns its content
     * 
     * @param string $file The filename
     * @param array $variables List of variables that will be passes to the file. They will be available in the file scope.
     * @return string The content of the file
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    protected function getComponentFileContent($file, $variables)
    {
        if (!is_string($file)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($variables)) {
            throw new \InvalidArgumentException('');
        }
        $app = \BearFramework\App::$instance;
        $variables['app'] = $app;
        $context = $app->getContext($file);
        $variables['context'] = $context;
        return parent::getComponentFileContent($file, $variables);
    }

}
