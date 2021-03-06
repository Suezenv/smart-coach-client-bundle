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

```bash
composer update suez/smart-coach-client-bundle
```

Add the bundle to the list of registered bundles in the `AppKernel.php` file

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Suez\Bundle\SmartCoachClientBundle\SuezSmartCoachClientBundle(),
            // ...
        );
    }
}
```

Configure the URL of the JWT service in the file `config.yaml`
/!\ Both `url` and `api_key` are mandatory parameters /!\

```yaml
suez_smart_coach_client:
    jwt:
        url: https://host-of-the-jwt-service/path
        api_key: 123456789qwertyuiop
```


## Usage

To fetch a JWT token inside a controller use the service `suez_jwt.provider.jwt_token`

```php
$servicePoint = '1234567890123';
$contractedAt = new \DateTime('2017-01-01');

try {
    $jwtToken = $this->get('suez_smart_coach_client.jwt')->getJwtToken($servicePoint, $contractedAt);
    $reponse = sprintf(
        'The following JWT token allow the use of Suez SmartCoach APIs: %s%s',
        "\n",
        $jwtToken
    );
} catch (\Requests_Exception $exception) {
    $reponse = sprintf('Response from the JWT server: %s', $exception->getMessage());
}

return new Response($reponse);
```
