<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
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
     *
     */
    private static $newCompilerCache = null;

    /**
     *
     */
    private static $newComponentCache = null;

    /**
     * Adds an alias
     * 
     * @param string $alias The alias
     * @param string $original The original source name
     * @return IvoPetkov\BearFramework\Addons\HTMLServerComponents Instance of itself.
     */
    public function addAlias(string $alias, string $original)
    {
        $this->aliases[] = ['alias' => $alias, 'original' => $original];
        return $this;
    }

    /**
     * Converts components code (if any) into HTML code
     * 
     * @param string $content The content to be processed
     * @param array $options Compiler options
     * @return string The result HTML code
     */
    public function process($content, array $options = [])
    {
        if ((is_string($content) && strpos($content, '<component') !== false) || $content instanceof \IvoPetkov\HTMLServerComponent) {
            if (self::$newCompilerCache === null) {
                self::$newCompilerCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Compiler();
            }
            $compiler = clone(self::$newCompilerCache);
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
    public function make()
    {
        if (self::$newComponentCache === null) {
            self::$newComponentCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Component();
        }
        return clone(self::$newComponentCache);
    }

}
