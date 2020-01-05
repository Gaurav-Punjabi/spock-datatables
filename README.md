# Spock DataTables
A laravel package to handle the server side processing of DataTables jQuery Plugin via AJAX option by using Eloquent Query Builder.

![LICENSE.md](https://badgen.net/badge/Php/v7+/green)
![LICENSE.md](https://badgen.net/badge/Packagist/v9.8.0/blue) 
![LICENSE.md](https://badgen.net/badge/Laravel/v5.5+/orange) 
![LICENSE.md](https://badgen.net/badge/LICENSE/MIT/purple)

## Requirements
 * PHP >= 7.0
 * Laravel >= 5.5
 * jQuery Datatables v1.10x
 
## Quick Installation
```bash
$ composer require fluidtech/spock-datatables
```

#### Setup Service Provider
Register provider on you `conifg\app.php` file.
```php
'providers' => [
    ...,
    \FluidTech\SpockDataTables\SpockServiceProvider::class
]
``` 
And that's it! Now you can start building out DataTables faster!


## License

The MIT License (MIT). Please see [License File](https://github.com/Gaurav-Punjabi/spock-datatables/blob/master/LICENSE.md) for more information.
