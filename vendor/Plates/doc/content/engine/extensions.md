+++
title = "Extensions"
linkTitle = "Engine Extensions"
[menu.main]
parent = "templates"
weight = 5
+++

Creating extensions couldn't be easier, and can really make Plates sing for your specific project. Start by creating a class that implements `\League\Plates\Extension\ExtensionInterface`. Next, register your template [functions]({{< relref "templates/functions.md" >}}) within a `register()` method.

## Simple extensions example

~~~ php
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class ChangeCase implements ExtensionInterface
{
    public function register(Engine $templates)
    {
        $templates->registerFunction('uppercase', [$this, 'uppercaseString']);
        $templates->registerFunction('lowercase', [$this, 'lowercaseString']);
    }

    public function uppercaseString($var)
    {
        return strtoupper($var);
    }

    public function lowercaseString($var)
    {
        return strtolower($var);
    }
}
~~~

To use this extension in your template, simply call your new functions:

~~~ php
<p>Hello, <?=$this->e($this->uppercase($name))?></p>
~~~

They can also be used in a [batch]({{< relref "templates/functions.md#batch-function-calls" >}}) compatible function:

~~~ php
<h1>Hello <?=$this->e($name, 'uppercase')</h1>
~~~

## Single method extensions

Alternatively, you may choose to expose the entire extension object to the template using a single function. This can make your templates more legible and also reduce the chance of conflicts with other extensions.

~~~ php
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class ChangeCase implements ExtensionInterface
{
    public function register(Engine $templates)
    {
        $templates->registerFunction('case', [$this, 'getObject']);
    }

    public function getObject()
    {
        return $this;
    }

    public function upper($var)
    {
        return strtoupper($var);
    }

    public function lower($var)
    {
        return strtolower($var);
    }
}
~~~

To use this extension in your template, first call the primary function, then the secondary functions:

~~~ php
<p>Hello, <?=$this->e($this->case()->upper($name))?></p>
~~~

## Loading extensions

To enable an extension, load it into the [templates]({{< relref "templates/overview.md" >}}) object using the `loadExtension()` method.

~~~ php
$templates->loadExtension(new ChangeCase());
~~~

## Accessing the templates and template

It may be desirable to access the `templates` or `template` objects from within your extension. Plates makes both of these objects available to you. The templates is automatically passed to the `register()` method, and the template is assigned as a parameter on each function call.

~~~ php
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class MyExtension implements ExtensionInterface
{
    protected $templates;
    public $template; // must be public

    public function register(Engine $templates)
    {
        $this->templates = $templates;

        // Access template data:
        $data = $this->template->data();

        // Register functions
        // ...
    }
}
~~~
