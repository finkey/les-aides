Usage
=====

```php
<?php
use Finkey\LesAides\Factory\ApiFactory;
use Finkey\LesAides\Builder\SearchBuilder;
use Finkey\LesAides\Exception\ApiException;

$factory = new ApiFactory();
$api = $factory->createApi('myToken');

try {
    $result = $api->search(
        (new SearchBuilder())
            ->setSiren('mySiren')
            ->addDomaine('1234')
    );
} catch (ApiException $e) {
    // :( 
}
```