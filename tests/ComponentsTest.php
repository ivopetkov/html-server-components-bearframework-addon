<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) 2016 Ivo Petkov
 * Free to use under the MIT license.
 */

/**
 * @runTestsInSeparateProcesses
 */
class ComponentsTest extends BearFrameworkAddonTestCase
{

    /**
     * 
     */
    public function testProccess()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html><html><head></head><body>content</body></html>';
        $result = $app->components->process('<component src="data:base64,' . base64_encode($content) . '"></component>');
        $this->assertTrue($result === $content);
    }

    /**
     * 
     */
    public function testAlias()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html><html><head></head><body>content</body></html>';
        $app->components->addAlias('newContent', 'data:base64,' . base64_encode($content));
        $result = $app->components->process('<component src="newContent" />');
        $this->assertTrue($result === $content);
    }

    /**
     * 
     */
    public function testDefaultVariables()
    {
        $app = $this->getApp();

        $this->createFile($app->config->appDir . '/component1.php', '<?php '
                . '$app = \BearFramework\App::$instance; '
                . '$context = $app->getContext(__FILE__); '
                . '?><!DOCTYPE html><html><head></head><body><?= get_class($context);?><?= realpath($context->dir);?><?= $component->innerHTML;?></body></html>');
        //echo file_get_contents($app->config->appDir . '/component1.php');
        $result = $app->components->process('<component src="file:' . $app->config->appDir . '/component1.php">text1</component>');
        $expectedResult = '<!DOCTYPE html><html><head></head><body>BearFramework\App\AppContext' . realpath($app->config->appDir) . 'text1</body></html>';
        $this->assertTrue($result === $expectedResult);

        $this->createFile($app->config->addonsDir . '/vendor1/addon1/component1.php', '<?php '
                . '$app = \BearFramework\App::$instance; '
                . '$context = $app->getContext(__FILE__); '
                . '?><!DOCTYPE html><html><head></head><body><?= get_class($context);?><?= realpath($context->dir);?><?= $component->innerHTML;?></body></html>');
        $this->createFile($app->config->addonsDir . '/vendor1/addon1/index.php', '');
        \BearFramework\Addons::register('vendor1/addon1', $app->config->addonsDir . '/vendor1/addon1/');
        $app->addons->add('vendor1/addon1');
        $result = $app->components->process('<component src="file:' . $app->config->addonsDir . '/vendor1/addon1/component1.php">text1</component>');
        $expectedResult = '<!DOCTYPE html><html><head></head><body>BearFramework\App\AddonContext' . realpath($app->config->addonsDir . '/vendor1/addon1') . 'text1</body></html>';
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * 
     */
    public function testFile()
    {
        $app = $this->getApp();

        $this->createFile($app->config->appDir . '/component1.php', '<!DOCTYPE html><html><head></head><body>content1<component src="file:' . $app->config->appDir . '/component2.php" /></body></html>');
        $this->createFile($app->config->appDir . '/component2.php', '<!DOCTYPE html><html><head></head><body>content2</body></html>');

        $app->components->addAlias('component1', 'file:' . $app->config->appDir . '/component1.php');

        $expectedResult = '<!DOCTYPE html><html><head></head><body>content1content2</body></html>';

        $result = $app->components->process('<component src="file:' . $app->config->appDir . '/component1.php" />');
        $this->assertTrue($result === $expectedResult);

        $result = $app->components->process('<component src="component1" />');
        $this->assertTrue($result === $expectedResult);

        $component = $app->components->create();
        $component->src = 'file:' . $app->config->appDir . '/component1.php';
        $result = $app->components->process($component);
        $this->assertTrue($result === $expectedResult);
        $result = $app->components->process((string) $component);
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * 
     */
    public function testInvalidArguments1()
    {
        $app = $this->getApp();
        $this->setExpectedException('InvalidArgumentException');
        $app->components->addAlias(1, 'longName');
    }

    /**
     * 
     */
    public function testInvalidArguments2()
    {
        $app = $this->getApp();
        $this->setExpectedException('InvalidArgumentException');
        $app->components->addAlias('shortName', 1);
    }

    /**
     * 
     */
    public function testInvalidArguments3()
    {
        $app = $this->getApp();
        $this->setExpectedException('InvalidArgumentException');
        $app->components->process(1);
    }

    /**
     * 
     */
    public function testInvalidArguments7a()
    {
        $app = $this->getApp();
        $this->setExpectedException('Exception');
        $app->components->process('<component src="file:missing/dir/component1.php" />');
    }

    /**
     * 
     */
//    public function testInvalidArguments7b()
//    {
//        $app = $this->getApp();
//
//        $wrongDir = $this->getTestDir() . 'wrongdir' . uniqid() . '/';
//        $this->createDir($wrongDir);
//        $this->createFile($wrongDir . 'component1.php', '<!DOCTYPE html><html><head></head><body>content</body></html>');
//
//        $this->setExpectedException('Exception');
//        $app->components->process('<component src="file:' . $wrongDir . 'component1.php" />');
//    }
}
