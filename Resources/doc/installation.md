# Installation

The bundle is only compatible with Symfony >= 2.1

### Add the WidopFrameworkExtraBundle to your composer configuration

Add the bundle to the require section of your `composer.json`

``` json
{
    "require": {
        "widop/framework-extra-bundle": "1.0.*@dev"
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
