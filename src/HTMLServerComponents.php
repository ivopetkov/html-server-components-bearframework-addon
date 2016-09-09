<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

namespace IvoPetkov\BearFramework\Addons;

/**
 * HTML Server Components utilities
 */
class HTMLServerComponents
{

    /**
     * Stores the added aliases
     * 
     * @var array 
     */
    private $aliases = [];

    /**
     * Adds an alias
     * 
     * @param string $alias The alias
     * @param string $original The original source name
     * @throws \InvalidArgumentException
     * @return void No value is returned
     */
    public function addAlias($alias, $original)
    {
        if (!is_string($alias)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($original)) {
            throw new \InvalidArgumentException('');
        }
        $this->aliases[] = ['alias' => $alias, 'original' => $original];
    }

    /**
     * Converts components code (if any) into HTML code
     * 
     * @param string $content The content to be processed
     * @param array $options Compiler options
     * @return string The result HTML code
     * @throws \InvalidArgumentException
     */
    public function process($content, $options = [])
    {
        if (!is_string($content)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($options)) {
            throw new \InvalidArgumentException('');
        }
        if (strpos($content, '<component') !== false) {
            $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Compiler();
            foreach ($this->aliases as $alias) {
                $compiler->addAlias($alias['alias'], $alias['original']);
            }
            return $compiler->process($content, $options);
        }
        return $content;
    }

    /**
     * Creates a component from the file specified and processes the content
     * 
     * @param string $file The file to be run as component
     * @param array $attributes Component object attributes
     * @param string $innerHTML Component object innerHTML
     * @param array $variables List of variables that will be passes to the file. They will be available in the file scope.
     * @param array $options Compiler options
     * @return string The result HTML code
     * @throws \InvalidArgumentException
     */
    public function processFile($file, $attributes = [], $innerHTML = '', $variables = [], $options = [])
    {
        if (!is_string($file)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($attributes)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($innerHTML)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($variables)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($options)) {
            throw new \InvalidArgumentException('');
        }
        $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Compiler();
        foreach ($this->aliases as $alias) {
            $compiler->addAlias($alias['alias'], $alias['original']);
        }
        return $compiler->processFile($file, $attributes, $innerHTML, $variables, $options);
    }

}
