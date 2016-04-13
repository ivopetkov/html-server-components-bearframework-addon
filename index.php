<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

use \BearFramework\App;
use IvoPetkov\BearFramework\Addons\HTMLServerComponents;

$app->classes->add(HTMLServerComponents::class, $context->dir . 'src/HTMLServerComponents.php');
$app->classes->add(HTMLServerComponents\Compiler::class, $context->dir . 'src/HTMLServerComponents/Compiler.php');
$app->classes->add(HTMLServerComponents\Component::class, $context->dir . 'src/HTMLServerComponents/Component.php');

$app->container->set('components', HTMLServerComponents::class);

$app->hooks->add('responseCreated', function($response) use($app) {
    if ($response instanceof App\Response\HTML) {
        $response->content = $app->components->process($response->content);
    }
});
