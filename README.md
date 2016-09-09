# HTML Server Components
Addon for Bear Framework

This addon brings HTML Server Components to [Bear Framework](https://bearframework.com/). It automatically converts components code into HTML code when the framework executes the `responseCreated` hook.

[![Build Status](https://travis-ci.org/ivopetkov/html-server-components-bearframework-addon.svg)](https://travis-ci.org/ivopetkov/html-server-components-bearframework-addon)
[![Latest Stable Version](https://poser.pugx.org/ivopetkov/html-server-components-bearframework-addon/v/stable)](https://packagist.org/packages/ivopetkov/html-server-components-bearframework-addon)
[![codecov.io](https://codecov.io/github/ivopetkov/html-server-components-bearframework-addon/coverage.svg?branch=master)](https://codecov.io/github/ivopetkov/html-server-components-bearframework-addon?branch=master)
[![License](https://poser.pugx.org/ivopetkov/html-server-components-bearframework-addon/license)](https://packagist.org/packages/ivopetkov/html-server-components-bearframework-addon)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1f6d2c1709f34d7b8ea547fa340ed7b5)](https://www.codacy.com/app/ivo_2/html-server-components-bearframework-addon)

## Download and install

**Install via Composer**

```shell
composer require ivopetkov/html-server-components-bearframework-addon
```

**Download an archive**

Download the [latest release](https://github.com/ivopetkov/html-server-components-bearframework-addon/releases) from the [GitHub page](https://github.com/ivopetkov/html-server-components-bearframework-addon) and include the autoload file.
```php
include '/path/to/the/addon/autoload.php';
```

## Enable the addon
Enable the addon for your Bear Framework application.

```php
$app->addons->add('ivopetkov/html-server-components-bearframework-addon');
```


## Documentation

A reference to the HTML Server Components object (IvoPetkov\BearFramework\Addons\HTMLServerComponents) is available at `$app->components`

### Examples
Let's create a demo component file at app/components/footer.php
```html
<html>
    <body>
        <footer>This is the footer</footer>
    </body>
</html>
```
Convert components code into HTML code
```php
echo $app->components->process('<component src="file:app/components/footer.php" />');
// Output:
// <!DOCTYPE html><html><head></head><body><footer>This is the footer</footer></body></html>
```
Create aliases
```php
$app->components->addAlias('footer', 'file:app/components/footer.php');
echo $app->components->process('<component src="footer" />');
// Output:
// <!DOCTYPE html><html><head></head><body><footer>This is the footer</footer></body></html>
```

### Classes


#### IvoPetkov\BearFramework\Addons\HTMLServerComponents
HTML Server Components utilities

##### Methods

```php
public void addAlias ( string $alias , string $original )
```

Adds an alias

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$alias`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The alias

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$original`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The original source name

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned

```php
public string process ( string $content [, array $options = [] ] )
```

Converts components code (if any) into HTML code

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$content`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The content to be processed

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$options`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Compiler options

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The result HTML code

```php
public string processFile ( string $file [, array $attributes = [] ]  [, string $innerHTML = '' ]  [, array $variables = [] ]  [, array $options = [] ] )
```

Creates a component from the file specified and processes the content

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$file`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The file to be run as component

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$attributes`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Component object attributes

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$innerHTML`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Component object innerHTML

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$variables`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List of variables that will be passes to the file. They will be available in the file scope.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$options`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Compiler options

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The result HTML code


## License
HTML Server Components addon for Bear Framework is open-sourced software. It's free to use under the MIT license. See the [license file](https://github.com/ivopetkov/html-server-components-bearframework-addon/blob/master/LICENSE) for more information.

## Author
This addon is created by Ivo Petkov. Feel free to contact me at [@IvoPetkovCom](https://twitter.com/IvoPetkovCom) or [ivopetkov.com](https://ivopetkov.com).
