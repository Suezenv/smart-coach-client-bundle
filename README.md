Suez JWT Bundle
===============

This bundle provides services that helps fetching JWT token from Suez.


## Installation

Add the bundle to your application

```bash
composer require suez/jwt-bundle
```

Add the bundle to the list of registered bundles in the `AppKernel.php` file

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Suez\Bundle\JwtBundle\SuezJwtBundle(),
            // ...
        );
    }
}
```

Configure the URL of the JWT service in the file `config.yaml`
/!\ Both `url` and `apiKey` are mandatory parameters /!\

```yaml
suez_jwt:
    url: https://host-of-the-jwt-service/path
    apiKey: 123456789qwertyuiop
```


## Usage

To fetch a JWT token inside a controller use the service `suez_jwt.provider.jwt_token`

```php
$servicePoint = 'Y123456789QWERTY';
$contractedAt = new \DateTime('2017-12-25');
$jwtToken = $this->get('suez_jwt.provider.jwt_token')->getJwtToken($servicePoint, $contractedAt);
```
