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
