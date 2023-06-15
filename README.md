# advans/php-api-validador-cfdi

[![Latest Stable Version](https://img.shields.io/packagist/v/advans/php-api-validador-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-validador-cfdi)
[![Total Downloads](https://img.shields.io/packagist/dt/advans/php-api-validador-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-validador-cfdi)

## Instalación usando Composer

```sh
$ composer require advans/php-api-validador-cfdi
```

## Ejemplo

````php
$config = new \Advans\Api\ValidadorCFDI\Config([
    'base_url' => '*************************',
    'key' => '**********************'
]);
$service_validador_cfdi = new \Advans\Api\ValidadorCFDI\ValidadorCFDI($config);

$response = $service_validador_cfdi->validar('...xml...');
if (!$response->valido) {
    echo $response->error['message'];
}
````

## Configuración

| Parámetro | Valor por defecto | Descripción |
| :--- | :--- | :--- |
| base_url | null | URL de la API |
| key | null | API Key |
