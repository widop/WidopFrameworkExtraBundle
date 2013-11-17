# UPGRADE

## From 0.1.0 to 1.0.0

 * The Symfony 2.0 support has been dropped.
 * All annotations have been disabled by default.
 * The `annotations` configuration sub-level has been removed.

Before:

``` yaml
widop_framework_extra:
    xml_http_request:
        annotations: true
    json_template:
        annotations: true
```

After:

``` yaml
widop_framework_extra:
    xml_http_request: true
    json_template:    true
```
