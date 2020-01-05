# Spock DataTables
A laravel package to handle the server side processing of DataTables jQuery Plugin via AJAX option by using Eloquent Query Builder.

![LICENSE.md](https://badgen.net/badge/Php/v7+/green)
![LICENSE.md](https://badgen.net/badge/Packagist/v9.8.0/blue) 
![LICENSE.md](https://badgen.net/badge/Laravel/v5.5+/orange) 
![LICENSE.md](https://badgen.net/badge/LICENSE/MIT/purple)

- [Requirements Started](#requirements)
- [Installation](#quick-installation)
- [Documentation](#documentation)
  - [Eloquent Query Builder](#using-eloquent-query-builder)
- [License](#license)


## Requirements
 * PHP >= 7.0
 * Laravel >= 5.5
 * jQuery Datatables v1.10x
 
## Quick Installation
```bash
$ composer require fluidtech/spock-datatables
```

#### Add service provider
Register provider on you `conifg\app.php` file.
```php
'providers' => [
    ...,
    \FluidTech\SpockDataTables\SpockServiceProvider::class
]
``` 
And that's it! Now you can start building out DataTables faster!

### Documentation
1. Using Eloquent Query Builder
    
    Fetches the and returns the records using the given query.
    ##### Syntax
    ```php
       $expectedResponse = \FluidTech\SpockDataTables\DataTable::of($query, $list_of_columns)
           ->make();
    ```
    * <b>Accepts</b>
        * `$query` : The base query from which records needs to be fetched.
        * `$list_of_columns` : An list of column names that needs to be displayed. <br> 
        <b>Note</b> : The sequence of columns should be the same as specified on the client side.
        
    ##### Example

    ```php
    $query = DB::table('users');
    
    return \FluidTech\SpockDataTables\DataTable::of($query, [
            "name", 
            "phone_number"
        ])
        ->make();
    ```
2. #### Using Fluent Query Builder (Coming Soon)
3. #### Using Collection (Coming Soon)


## License

The MIT License (MIT). Please see [License File](https://github.com/Gaurav-Punjabi/spock-datatables/blob/master/LICENSE.md) for more information.
