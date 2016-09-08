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

## API

A reference to the HTML Server Components object is available at
```
$app->components
```

### addAlias
```
public void addAlias ( string $alias, string $original );
```
Create an alias

**_Parameters:_**

**$alias**
The alias

**$original**
The original source

**_Return value:_**

void

**_Example:_**

Calling
```
$app->components->addAlias('footer', 'file:app/components/footer.php');
```
will enable you to write 
```
<component src="footer" />
```
instead of 
```
<component src="file:app/components/footer.php" />
```

### process
```
public string process($content, $options = []);
```
Converts components code to HTML code

### processFile
```
public string processFile($file, $attributes = [], $innerHTML = '', $variables = [], $options = []);
```
Converts components code in a file to HTML code

## License
HTML Server Components addon for Bear Framework is open-sourced software. It's free to use under the MIT license. See the [license file](https://github.com/ivopetkov/html-server-components-bearframework-addon/blob/master/LICENSE) for more information.

## Author
This addon is created by Ivo Petkov. Feel free to contact me at [@IvoPetkovCom](https://twitter.com/IvoPetkovCom) or [ivopetkov.com](https://ivopetkov.com).
