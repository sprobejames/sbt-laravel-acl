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
You can activate the ACL by declaring it on your controller:  
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