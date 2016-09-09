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

```
composer require ivopetkov/html-server-components-bearframework-addon
```

**Download a zip file**

Download the [latest release](https://github.com/ivopetkov/html-server-components-bearframework-addon/releases) from our GitHub page and include the autoload file.
```
include '/path/to/the/addon/autoload.php';
```

## Enable the addon
Enable the addon for your application.

```
$app->addons->add('ivopetkov/html-server-components-bearframework-addon');
```


## Documentation

A reference to the HTML Server Components object (IvoPetkov\BearFramework\Addons\HTMLServerComponents) is available at `$app->components`

### Examples
Let's start by creating a demo component file located at app/components/footer.php
```
<html>
    <body>
        <footer>This is the footer</footer>
    </body>
</html>
```
Converting components code into HTML code
```
echo $app->components->process('<component src="file:app/components/footer.php" />');
// Output:
// <!DOCTYPE html><html><head></head><body><footer>This is the footer</footer></body></html>
```
Creating aliases
```
$app->components->addAlias('footer', 'file:app/components/footer.php');
echo $app->components->process('<component src="footer" />');
// Output:
// <!DOCTYPE html><html><head></head><body><footer>This is the footer</footer></body></html>
```

### Classes


#### IvoPetkov\BearFramework\Addons\HTMLServerComponents
HTML Server Components utilities

##### Methods

```
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

```
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

```
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

#### IvoPetkov\BearFramework\Addons\HTMLServerComponents\Compiler
HTML Server Components compiler. Converts components code into HTML code.

##### Constants

`const string VERSION = '0.4.0'`

##### Methods

```
protected \IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component constructComponent ( [ array $attributes = [] ]  [, string $innerHTML = '' ] )
```

Constructs a component object

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$attributes`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The attributes of the component object

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$innerHTML`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The innerHTML of the component object

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A component object

```
protected string getComponentFileContent ( string $file , array $variables )
```

Includes a component file and returns its content

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$file`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The filename

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$variables`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List of variables that will be passes to the file. They will be available in the file scope.

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The content of the file

```
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

```
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

```
public string processData ( string $data [, array $options = [] ] )
```

Creates a component from the data specified and processes the content

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$data`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The data to be used as component content. Currently only base64 encoded data is allowed.

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$options`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Compiler options

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The result HTML code

```
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

#### IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component
Used to create the $component object that is passed to the corresponding file

##### Properties

`public array $attributes = []` Component tag attributes

`public string $innerHTML = ''` Component tag innerHTML

##### Methods

```
public __construct ( void )
```

The constructor

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned.

```
public string|null getAttribute ( string $name [, string|null $defaultValue ] )
```

Returns value of an attribute

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$defaultValue`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The default value of the attribute (if missing)

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The value of the attribute or the defaultValue specified

```
public void setAttribute ( string $name , string $value )
```

Sets new value to the attribute specified

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$value`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The new value of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned

```
public void removeAttribute ( string $name )
```

Removes attribute

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned

```
public string|null __get ( string $name )
```

Provides acccess to the component attributes via properties

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The value of the attribute or null if missing

```
public void __set ( string $name , string $value )
```

Provides acccess to the component attributes via properties

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$value`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The new value of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned

```
public boolean __isset ( string $name )
```

Provides acccess to the component attributes via properties

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TRUE if the attribute exists, FALSE otherwise

```
public void __unset ( string $name )
```

Provides acccess to the component attributes via properties

_Parameters_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`$name`

 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The name of the attribute

_Returns_

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No value is returned


## License
HTML Server Components addon for Bear Framework is open-sourced software. It's free to use under the MIT license. See the [license file](https://github.com/ivopetkov/html-server-components-bearframework-addon/blob/master/LICENSE) for more information.

## Author
This addon is created by Ivo Petkov. Feel free to contact me at [@IvoPetkovCom](https://twitter.com/IvoPetkovCom) or [ivopetkov.com](https://ivopetkov.com).
