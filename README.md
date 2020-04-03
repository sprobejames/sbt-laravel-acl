# Sprobe Laravel Basic ACL

Simple Laravel ACL implementation using groups and permissions.  

## Installation
Update your project's `composer.json` file:
```
{
    "require": {
        ...
        ...
        "sprobe/acl": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "ssh://phabricator-vcs@phabricator.sprobe.ph/diffusion/435/sbt-laravel-acl.git"
        }
    ]
}
```
  
In your terminal run the following command:
```
composer require sprobe/acl
```
  
After running composer install, add the following line to your `config/app.php` file  
```
'providers' => [
    ...
    ...

    // load the acl service provider
    Sprobe\Acl\SprobeAclServiceProvider::class,
]
```

## How to Use
First run the migration to create the database tables needed:
```
php artisan migrate
```
  
Create a group via artisan command:
```
php artisan acl:make-group Administrator
```
  
Then create a resource via artisan command:
```
php artisan acl:make-resource users
```
Note that the resource should match your route
```
Route::post('users', 'UserController@create');
```
  
Then create the Read and Write permissions via artisan command:
```
php artisan acl:make-permission Write
php artisan acl:make-permission Read
```
  
Add the following `Permissible` trait to your user model `app\Models\User.php`
```
...
use Sprobe\Acl\Traits\Permissible;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, Permissible;
...

```
You can assign the user to a group on your controller/service/repository
```
$user = App\Models\User::find(1);
$user->assignToGroup('Administrator');
```
  
Then you can give the group permission to that resource:
```
$group = Sprobe\Acl\Models\Group::findByName('Administrator');
$group->givePermissionToResource('users', true); // set second param to true if you want to give Write permission, false if read-only
```
  
You can activate the ACL by declaring it on your controller e.g `UserController.php`:  
```
public function __construct()
{
    parent::__construct();

    // enable api middleware
    $this->middleware('acl');
}
```
or directly on your routes:  
```
Route::get('users', 'UserController@index')->middleware('acl');
```
  