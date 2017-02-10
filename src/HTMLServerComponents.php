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
        if (!is_string($content) && !($content instanceof \IvoPetkov\HTMLServerComponent)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_array($options)) {
            throw new \InvalidArgumentException('');
        }
        if ((is_string($content) && strpos($content, '<component') !== false) || $content instanceof \IvoPetkov\HTMLServerComponent) {
            $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Compiler();
            foreach ($this->aliases as $alias) {
                $compiler->addAlias($alias['alias'], $alias['original']);
            }
//            $app = \BearFramework\App::get();
//            if (!isset($options['variables'])) {
//                $options['variables'] = [];
//            }
//            $options['variables']['app'] = $app;
            return $compiler->process($content, $options);
        }
        return $content;
    }

    /**
     * Creates new component and return it
     * 
     * @return \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component
     */
    public function create()
    {
        return new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
    }

}
