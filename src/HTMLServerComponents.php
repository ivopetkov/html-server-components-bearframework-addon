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
     * Stores aliases
     * 
     * @var array 
     */
    private $aliases = [];

    /**
     * Creates an alias
     * 
     * @param string $alias The alias
     * @param string $original The original source
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
     * Runs the compiler over the content specified
     * @param string $content The content to be processed
     * @param array $options
     * @throws \InvalidArgumentException
     * @return string The processed content
     */
    public function process($content, $options = [])
    {
        if (!is_string($content)) {
            throw new \InvalidArgumentException('');
        }
        if (strpos($content, '<component') !== false) {
            $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Compiler();
            foreach ($this->aliases as $alias) {
                $compiler->addAlias($alias['alias'], $alias['original']);
            }
            return $compiler->process($content, $options);
        }
        return $content;
    }

    /**
     * 
     * @param string $file
     * @param array $attributes
     * @param string $innerHTML
     * @param array $variables
     * @param array $options
     * @return string
     */
    public function processFile($file, $attributes = [], $innerHTML = '', $variables = [], $options = [])
    {
        $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Compiler();
        foreach ($this->aliases as $alias) {
            $compiler->addAlias($alias['alias'], $alias['original']);
        }
        return $compiler->processFile($file, $attributes, $innerHTML, $variables, $options);
    }

}
