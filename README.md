An extension to Symfony2 FrameworkBundle that adds annotation configuration for Controller classes.

The supported annotations are :

 - @XmlHttpRequest: Checks if the request is an XML HTTP Request.
 - @JsonTemplate: Converts the controller result to a JSON response.

# Installation

## Add WidopFrameworkExtraBundle to your vendor/bundles/ directory

### Using the vendors script

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

### Using submodules

``` bash
$ git submodule add http://github.com/widop/WidopFrameworkExtraBundle.git vendor/bundles/Widop/FrameworkExtraBundle
```

## Add the Widop namespace to your autoloader

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    //..
    'Widop' => __DIR__.'/../vendor/bundles',
);
```

## Add the WidopFrameworkExtraBundle to your application kernel

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

# Configuration

All features provided by the bundle are enabled by default when the bundle is registered in your Kernel class.
The default configuration is as follow:

``` yaml
# app/config/config.yml

widop_framework_extra:
    xml_http_request: { annotations: true }
    json_template:    { annotations: true }
```

You can disable some annotations by defining one or more settings to false.

# Usage

## XML HTTP Request Annotation

```` php
<?php

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Widop\FrameworkExtraBundle\Configuration\XmlHttpRequest;

class AnnotController extends Controller
{
    /**
     * @XmlHttpRequest
     */
    public function indexAction()
    {

    }
}
````

If the request is not an XML HTTP Request, an NotFoundHttpException is thrown.

## JSON Template Annotation

```` php
<?php

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Widop\FrameworkExtraBundle\Configuration\JsonTemplate;

class AnnotController extends Controller
{
    /**
     * @JsonTemplate
     */
    public function indexAction()
    {
        return array('foo' => 'bar');
    }
}
````

The response is automatically converted to a JSON response.

# License

The bundle is under the MIT license. See the complete license [here](http://github.com/widop/WidopFrameworkExtraBundle/blob/master/Resources/meta/LICENSE).
