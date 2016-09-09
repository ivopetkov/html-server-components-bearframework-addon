# HTML Server Components
Addon for Bear Framework

This addon brings HTML Server Components to [Bear Framework](https://bearframework.com/). It automatically converts components code into HTML code when the framework executes the `responseCreated` hook.

[![Latest Stable Version](https://poser.pugx.org/ivopetkov/html-server-components-bearframework-addon/v/stable)](https://packagist.org/packages/ivopetkov/html-server-components-bearframework-addon)
[![License](https://poser.pugx.org/ivopetkov/html-server-components-bearframework-addon/license)](https://packagist.org/packages/ivopetkov/html-server-components-bearframework-addon)

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



### IvoPetkov\BearFramework\Addons\HTMLServerComponents
HTML Server Components utilities

#### Properties
`private array $aliases = []` Stores aliases



#### Methods

**`public void addAlias ( string $alias , string $original )`**


Creates an alias

_Parameters_

`string $alias` The alias

`string $original` The original source


_Returns_

No value is returned

**`public string process ( string $content [, array $options = [] ] )`**


Runs the compiler over the content specified

_Parameters_

`string $content` The content to be processed

`array $options = []`


_Returns_

The processed content

**`public string processFile ( string $file [, array $attributes = [] ]  [, string $innerHTML = '' ]  [, array $variables = [] ]  [, array $options = [] ] )`**


_Parameters_

`string $file`

`array $attributes = []`

`string $innerHTML = ''`

`array $variables = []`

`array $options = []`


_Returns_



### IvoPetkov\BearFramework\Addons\HTMLServerComponents\Compiler
Process HTML code and transforms component tags

	/* Constants */
	const string VERSION = '0.4.0'

#### Methods

**`protected \BearFramework\App\Component constructComponent ( [ array $attributes = [] ]  [, string $innerHTML = '' ] )`**


Constructs a Component object

_Parameters_

`array $attributes = []` The attributes of the component tag

`string $innerHTML = ''` The innerHTML of the component tag


_Returns_

A component object

**`protected string getComponentFileContent ( string $file , array $variables )`**


Includes the component file providing variables

_Parameters_

`string $file` The filename

`array $variables` List of variables that will be available in the file


_Returns_



**`public void addAlias ( string $alias , string $original )`**


Registers an alias

_Parameters_

`string $alias`

`string $original`


_Returns_

No value is returned.

**`public string process ( string $html [, array $options = [] ] )`**


Process (merge) components

_Parameters_

`string $html`

`array $options = []`


_Returns_



**`public string processData ( string $data [, array $options = [] ] )`**


_Parameters_

`string $data`

`array $options = []`


_Returns_



**`public string processFile ( string $file [, array $attributes = [] ]  [, string $innerHTML = '' ]  [, array $variables = [] ]  [, array $options = [] ] )`**


_Parameters_

`string $file`

`array $attributes = []`

`string $innerHTML = ''`

`array $variables = []`

`array $options = []`


_Returns_



### IvoPetkov\BearFramework\Addons\HTMLServerComponents\Component
HTML Server Components object

#### Properties
`public array $attributes = []`

`public string $innerHTML = ''`


#### Methods

**`public string|null getAttribute ( string $name [, string|null $defaultValue ] )`**


_Parameters_

`string $name`

`string|null $defaultValue`


_Returns_



**`public void setAttribute ( string $name , string $value )`**


_Parameters_

`string $name`

`string $value`


_Returns_

No value is returned.

**`public void removeAttribute ( string $name )`**


_Parameters_

`string $name`


_Returns_

No value is returned.

**`public string|null __get ( string $name )`**


_Parameters_

`string $name`


_Returns_



**`public void __set ( string $name , string $value )`**


_Parameters_

`string $name`

`string $value`


_Returns_



**`public boolean __isset ( string $name )`**


_Parameters_

`string $name`


_Returns_



**`public void __unset ( string $name )`**


_Parameters_

`string $name`


_Returns_

No value is returned.



## License
HTML Server Components addon for Bear Framework is open-sourced software. It's free to use under the MIT license. See the [license file](https://github.com/ivopetkov/html-server-components-bearframework-addon/blob/master/LICENSE) for more information.

## Author
This addon is created by Ivo Petkov. Feel free to contact me at [@IvoPetkovCom](https://twitter.com/IvoPetkovCom) or [ivopetkov.com](https://ivopetkov.com).
