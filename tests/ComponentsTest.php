<?php

/*
 * HTML Server Components addon for Bear Framework
 * https://github.com/ivopetkov/html-server-components-bearframework-addon
 * Copyright (c) Ivo Petkov
 * Free to use under the MIT license.
 */

/**
 * @runTestsInSeparateProcesses
 */
class ComponentsTest extends BearFramework\AddonTests\PHPUnitTestCase
{

    private function fixProcessResult($result)
    {
        return str_replace('</head>' . "\n", '</head>', $result);
    }

    /**
     * 
     */
    public function testProccess()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html>' . "\n" . '<html><head><meta name="ad"></head><body>content</body></html>';
        $result = $app->components->process('<component src="data:base64,' . base64_encode($content) . '"></component>');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $content);
    }

    /**
     * 
     */
    public function testAlias()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>content</body></html>';
        $app->components->addAlias('newContent', 'data:base64,' . base64_encode($content));
        $result = $app->components->process('<component src="newContent" />');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $content);
    }

    /**
     * 
     */
    public function testTags()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>content</body></html>';
        $app->components->addTag('new-content', 'data:base64,' . base64_encode($content));
        $result = $app->components->process('<new-content/>');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $content);
    }

    /**
     * 
     */
    public function testEvents()
    {
        $app = $this->getApp();

        $content = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>content1</body></html>';
        $newContent = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>content2</body></html>';
        $app->components->addEventListener('makeComponent', function(\IvoPetkov\BearFramework\Addons\HTMLServerComponents\MakeComponentEventDetails $details) use ($newContent) {
            $details->component->setAttribute('src', 'data:base64,' . base64_encode($newContent));
        });
        $result = $app->components->process('<component src="data:base64,' . base64_encode($content) . '"></component>');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $newContent);
    }

    /**
     * 
     */
    public function testComponentVariable()
    {
        $app = $this->getApp();
        $tempDir = $this->getTempDir();
        $this->makeFile($tempDir . '/index.php', '<?php');
        $app->contexts->add($tempDir);

        $this->makeFile($tempDir . '/component1.php', '<?php '
                . '$app = \BearFramework\App::get(); '
                . '$context = $app->contexts->get(__DIR__); '
                . '?><!DOCTYPE html><html><head></head><body><?= get_class($context);?><?= realpath($context->dir);?><?= $component->innerHTML;?></body></html>');
        $result = $app->components->process('<component src="file:' . $tempDir . '/component1.php">text1</component>');
        $result = $this->fixProcessResult($result);
        $expectedResult = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>BearFramework\App\Context' . realpath($tempDir) . 'text1</body></html>';
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * 
     */
    public function testFile()
    {
        $app = $this->getApp();
        $tempDir = $this->getTempDir();

        $this->makeFile($tempDir . '/component1.php', '<!DOCTYPE html><html><head></head><body>content1<component src="file:' . $tempDir . '/component2.php" /></body></html>');
        $this->makeFile($tempDir . '/component2.php', '<!DOCTYPE html><html><head></head><body>content2</body></html>');

        $app->components->addAlias('component1', 'file:' . $tempDir . '/component1.php');

        $expectedResult = '<!DOCTYPE html>' . "\n" . '<html><head></head><body>content1content2</body></html>';

        $result = $app->components->process('<component src="file:' . $tempDir . '/component1.php" />');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $expectedResult);

        $result = $app->components->process('<component src="component1" />');
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $expectedResult);

        $component = $app->components->make();
        $component->src = 'file:' . $tempDir . '/component1.php';
        $result = $app->components->process($component);
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $expectedResult);
        $result = $app->components->process((string) $component);
        $result = $this->fixProcessResult($result);
        $this->assertTrue($result === $expectedResult);
    }

    /**
     * 
     */
    public function testInvalidArguments7a()
    {
        $app = $this->getApp();
        $this->expectException('Exception');
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
//        $this->makeFile($wrongDir . 'component1.php', '<!DOCTYPE html><html><head></head><body>content</body></html>');
//
//        $this->expectException('Exception');
//        $app->components->process('<component src="file:' . $wrongDir . 'component1.php" />');
//    }
}
