<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

use \BearFramework\App;
use IvoPetkov\BearFramework\Addons\HTMLServerComponents;

$app = App::get();
$context = $app->context->get(__FILE__);

$context->classes
        ->add(HTMLServerComponents::class, 'src/HTMLServerComponents.php')
        ->add(HTMLServerComponents\Internal\Compiler::class, 'src/HTMLServerComponents/Internal/Compiler.php')
        ->add(HTMLServerComponents\Internal\Component::class, 'src/HTMLServerComponents/Internal/Component.php');

$app->shortcuts->add('components', function() {
    return new HTMLServerComponents();
});

$app->hooks->add('responseCreated', function($response) use($app) {
    if (strpos($response->content, '<component') !== false) { // $response instanceof App\Response\HTML does not update NotFound and TemporaryUnavailable responses
        $response->content = $app->components->process($response->content);
    }
});
