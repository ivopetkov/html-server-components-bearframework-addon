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

    use \BearFramework\EventsTrait;

    /**
     * Stores the added aliases.
     * 
     * @var array 
     */
    private $aliases = [];

    /**
     * Stores the defined tags.
     * 
     * @var array 
     */
    private $tagNames = [];

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
    public function addAlias(string $alias, string $original): self
    {
        $this->aliases[$alias] = $original;
        return $this;
    }

    /**
     * Defines a new tag
     * 
     * @param string $tagName The alias
     * @param string $src The original source name
     * @return IvoPetkov\BearFramework\Addons\HTMLServerComponents Instance of itself.
     */
    public function addTag(string $tagName, string $src): self
    {
        $this->tagNames[$tagName] = $src;
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
        $found = false;
        if (is_string($content)) {
            $tagNames = array_keys($this->tagNames);
            $tagNames[] = 'component';
            foreach ($tagNames as $tagName) {
                if (strpos($content, '<' . $tagName) !== false) {
                    $found = true;
                    break;
                }
            }
        }
        if ($content instanceof \IvoPetkov\HTMLServerComponent) {
            $found = true;
        }
        if ($found) {
            if (self::$newCompilerCache === null) {
                self::$newCompilerCache = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Internal\Compiler($this);
            }
            $compiler = clone (self::$newCompilerCache);
            foreach ($this->aliases as $alias => $original) {
                $compiler->addAlias($alias, $original);
            }
            foreach ($this->tagNames as $tagName => $src) {
                $compiler->addTag($tagName, $src);
            }
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
        return clone (self::$newComponentCache);
    }
}
