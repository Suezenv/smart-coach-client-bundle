Suez SmartCoach Client Bundle
=============================

This bundle provides services that helps communicating with Suez Smart Coach services.


## Installation

Add the bundle to your dependencies in the `composer.json` file

```json
{
    "require": {
        "suez/smart-coach-client-bundle": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:Suezenv/smart-coach-client-bundle.git"
        }
    ]
```

Add the bundle to the list of registered bundles in the `AppKernel.php` file

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Suez\Bundle\SmartCoachClientBundle\SuezJwtBundle(),
            // ...
        );
    }
}
```

Configure the URL of the JWT service in the file `config.yaml`
/!\ Both `url` and `apiKey` are mandatory parameters /!\

```yaml
suez_smart_coach_client:
    jwt:
        url: https://host-of-the-jwt-service/path
        apiKey: 123456789qwertyuiop
```


## Usage

To fetch a JWT token inside a controller use the service `suez_jwt.provider.jwt_token`

```php
$servicePoint = 'Y123456789QWERTY';
$contractedAt = new \DateTime('2017-12-25');

try {
    $jwtToken = $this->get('suez_smart_coach_client.jwt')->getJwtToken($servicePoint, $contractedAt);
} catch (\Requests_Exception $exception) {
    // do something in case of the Suez SmartCoach Client does not respond with a JWT token
}
```
