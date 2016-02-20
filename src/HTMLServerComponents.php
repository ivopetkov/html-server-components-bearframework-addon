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
     * @var array 
     */
    private $aliases = [];

    /**
     * Adds alias to a specifil source
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
     * @throws \InvalidArgumentException
     * @return string The processed content
     */
    public function process($content)
    {
        if (!is_string($content)) {
            throw new \InvalidArgumentException('');
        }
        if (strpos($content, '<component') !== false) {
            $compiler = new \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Compiler();
            foreach ($this->aliases as $alias) {
                $compiler->addAlias($alias['alias'], $alias['original']);
            }
            return $compiler->process($content);
        } else {
            return $content;
        }
    }

    /**
     * Inserts HTML code (or HTML Component) in the position specified
     * @param string $target The HTML code where the insertion will be made
     * @param string $html The HTML code that will be inserted
     * @param string $position The position of the insertion
     * @throws \InvalidArgumentException
     * @return string The resulting HTML code (processed)
     */
    public function insertHTML($target, $html, $position = 'beforeBodyEnd')
    {
        if (!is_string($target)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($html)) {
            throw new \InvalidArgumentException('');
        }
        if (!is_string($position)) {
            throw new \InvalidArgumentException('');
        }
        //todo better
        $target = $this->process($target);
        $component = '<component src="data:base64,' . base64_encode($html) . '" />';
        if ($position === 'afterBodyBegin') {
            $result = str_replace('<body>', '<body>' . $component, $target);
        } elseif ($position === 'beforeBodyEnd') {
            $result = str_replace('</body>', $component . '</body>', $target);
        } else {
            throw new \InvalidArgumentException('');
        }
        return $this->process($result);
    }

}
