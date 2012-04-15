# Installation

## Symfony 2.1.*

### Add the WidopFrameworkExtraBundle to your composer configuration

Add the bundle to the require section of your `composer.json`

``` json
{
    "require": {
        "widop/framework-extra-bundle": "dev-master"
    }
}
```

Run the composer update command

``` bash
$ php composer.phar update
```

### Add the WidopFrameworkExtraBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        //..
        new Widop\FrameworkExtraBundle\WidopFrameworkExtraBundle(),
    );
}
```

## Symfony 2.0.*

### Add the WidopFrameworkExtraBundle to your vendor/bundles/ directory

#### Using the vendors script

Add the following lines in your ``deps`` file

```
[WidopFrameworkExtraBundle]
    git=http://github.com/widop/WidopFrameworkExtraBundle.git
    target=bundles/Widop/FrameworkExtraBundle
```

Run the vendors script

``` bash
$ php bin/vendors update
```

#### Using submodules

``` bash
$ git submodule add http://github.com/widop/WidopFrameworkExtraBundle.git vendor/bundles/Widop/FrameworkExtraBundle
```

### Add the Widop namespace to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    //..
    'Widop' => __DIR__.'/../vendor/bundles',
);
```

### Add the WidopFrameworkExtraBundle to your application kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        //..
        new Widop\FrameworkExtraBundle\WidopFrameworkExtraBundle(),
    );
}
```
