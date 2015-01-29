ModuleInterface
===============

This package contains the base interface to build framework-agnostic **modules**.

##Framework-agnostic modules?

Have a look at [the demo](http://github.com/framework-interop/framework-interop-demo).
It shows 3 modules, one using Symfony 2, one using Silex and one using Zend Framework 1.

## How it works

A module can provide a DI container and some instructions to be executed on init.

When the application is constructed, it will build a root DI container to which all the
module's containers will be chained.

The container your module returns must implement the `Interop\Container\ContainerInterface`
from [container-interop](http://github.com/container-interop/container-interop).


If your module is providing a routing mechanism, you should instead implement the
`HttpModuleInterface` that enables the module to catch incoming HTTP requests.

## How to write a module

You start by writing a class that implements `Interop\Framework\ModuleInterface`:

```php
namespace Acme\BlogModule;

class BlogModule extends ModuleInterface
{
    public function getName()
    {
        return 'blog';
    }

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @return ContainerInterface|null
     */
    public function getContainer(ContainerInterface $rootContainer)
    {
        return new Picotainer([
            "myService" => function() { return new MyService(); }
        ], $rootContainer);
    }

		/**
		 * You can do things on init.
		 */
		public function init() {
		    // Do stuff.
		}
}
```

The `init` method is called **after** the `getContainer` method by the application.

##Application? What application?

Obviously, you will need an application that register all modules and receives the
HTTP requests to pass them to the modules.

*framework-interop* provides a [default `Application`](http://github.com/framework-interop/application) class to bootstrap your project
but you can write your own!
