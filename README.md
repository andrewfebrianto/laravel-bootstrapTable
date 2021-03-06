# Laravel - BootstrapTable
This is an example of CRUD Data Product using Laravel 6.x and Bootstrap-Table

## Installation
### Clone repo

```bash
# clone the repo
$ git clone https://github.com/andrewfebrianto/laravel-bootstrapTable.git my-project

# install app's dependencies
$ composer install
```

### Configure database MySQL
Copy file ".env.example", and change its name to ".env". Then in file ".env" replace this database configuration:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=laravel_bootstraptable
- DB_USERNAME=root
- DB_PASSWORD=

Run Laravel migration

```bash
# run database migration and seed
$ php artisan migrate:refresh --seed
```

## Usage helper Bootstrap Table
Use helper Bootstrap Table in your controller <br/>
**NEVER USE SELECT(*)** when using this approach or your Bootstrap Table filtering/sorting may not work properly.

**Example**
```bash
$query = DB::table('product')
        ->select('id','product_code', 'product_name', 'qty', 'price');

return BootstrapTable::create($request, $query, true);
```

## Components
The following components are used in this project
- Laravel 6.x (https://laravel.com/)
- Bootstrap Table 1.16.0 (https://bootstrap-table.com/)
- Template CoreUI Free 3.0.0 (https://coreui.io/)
- jQuery 3.4.1 (https://jquery.com/)
- jQuery Validation 1.19.1 (https://jqueryvalidation.org/)
- SweetAlert2 (https://sweetalert2.github.io/)
- Toastr (https://codeseven.github.io/toastr/)
- Font Awesome 5 (https://fontawesome.com/)