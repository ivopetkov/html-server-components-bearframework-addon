<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

use BearFramework\App;
use IvoPetkov\BearFramework\Addons\HTMLServerComponents;

$app = App::get();
$context = $app->contexts->get(__DIR__);

$context->classes
        ->add('IvoPetkov\BearFramework\Addons\HTMLServerComponents', 'classes/HTMLServerComponents.php')
        ->add('IvoPetkov\BearFramework\Addons\HTMLServerComponents\*', 'classes/HTMLServerComponents/*.php');

$app->shortcuts
        ->add('components', function() {
            return new HTMLServerComponents();
        });
