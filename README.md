# Strategy-PHP

## Index

- [How to start](#howtostart)
- [All paths](#allpaths)
    - [Front-end](#frontend)
        - [Public files](#publicfiles)
            - [SCSS](#scss)
            - [Pictures](#pictures)
            - [JavaScript](#javascript)
        - [Views](#views)
    - [Back-end](#backend)
- [Design](#design)
- [Implemented](#implemented)
    - [Database](#database)
    - [Controllers](#controllers)
    - [Core](#core)
        - [Directives](#directives)
        - [Query](#query)
            - [UsualSQL](#usualsql)
        - [Routes](#routes)
        - [Validation](#validation)

## [How to start](#howtostart)

1. Install the dependances

Copy the file `Query.php` who's located at `_tmp/Query.php` to end up with the path `Server/Controllers/Core/Query.php`.
Once it's done, go inside the `Query.php` file and change your host, user and pswd (password) settings in the constructor:
```php
public function __construct($dbName = "", $host = "localhost", $user = 'root', $pswd = '') {
```

You shouldn't change the `$dbName` variable. Once it's done, go to the terminal and install the rest of dependances:
```terminal
composer install
```

2. Launch the project

Use the command:
```terminal
php -S localhost:8080 -t public
```
Or just use XAMPP or something like that and put the project inside the right folder.

## [All paths](#allpaths)

### [Front-end](#frontend)

You can access the front-end ressources easily in the `public/assets/` folder.
If you want to have access to a ressources from a view, then you'll need to checkout the path.

In the case you're using a `src` path, then you can directly linked it with the following :
```
assets/YOUR_PATH
```

For any `href` content, you're gonna have to keep in mind your possible paths or just tracking it. If you're having a path such as:
```
http://myWebsite.com/
http://myWebsite.com/myPage
```
you're gonna be fine just using `./assets/` as an `href` but links can be more trikky like:
```
http://myWebsite.com/specialPage/subPage
```
Since it's a page inside a page and not a getting parameter, we're gonna need to use `./../assets/` or going back as much as needed to get the assets access.

#### [Public files](#publicfiles)

##### [SCSS](#scss)
All `.scss` must be at :
```
public/assets/scss
```
the only exception at the moment being:
```
public/assets/style.scss
```

##### [Pictures](#pictures)
All `images` must be at :
```
public/assets/img
```

##### [JavaScript](#javascript)
All `.js` must be at :
```
public/assets/scripts
```

#### [Views](#views)

All views are `.php` pages containing the look of the website and any dynamic generated content depending on the datas given by the controller.

Shared ressources:
```
Server/Views/_shared
```
API:
```
Server/Views/API
```
Offline views:
```
Server/Views/Offline
```
Online views:
```
Server/Views/Online
```

### [Back-end](#backend)

The routes give us a specific path to go on the website. The controller is made to check, validate and give back a view from any visit or given datas on the route.

Controllers:
```
Server/Controllers
```
Routes:
```
Server/Routes
```

There's also some `.php` files or any other kind of scripts that could be executed at a specific time, thoses should be in the CRON folder.

CRON:
```
Server/CRON
```

## [Design](#design)
The HTML design must be made as simple as possible, as pure as possible and should be rendered as good as possible.
As such, design the mobile view first (don't go under 320px width, that's bullshit) then the desktop view (640px up to 3840px).

## [Implemented](#implemented)

### [Database](#database)
Nothing.

### [Controllers](#controllers)
Nothing, there's just a bunch of examples.

### [Core](#core)

#### [Directives](#directives)

Root directive:
The root directive is a directive you can explicitly write that return a string containing the path of the project's root.
```php
echo __ROOT__;
```

View directive:
The view directive is a directive you can explicitly write that return a string containing the path of the project's view folder.
```php
echo __VIEW__;
```

#### [Query](#query)

Query is made so any communication with the database could be made as simple as possible.
```php
$db = new Query('my_DB_Name');
$rows = $db->fetchAll("SELECT * FROM someTable"); // Get multiples rows
$row = $db->fetchAssoc("SELECT * FROM someTable where id=5", [ 5 ]); // Get a single row
$username = $db->fetchColumn("SELECT username FROM someTable where id=?", [ 5 ]); // Get a single column value
$db->execute("DELETE FROM students WHERE idStudent=?", [ 2 ]); // Execute a query
$db->kill(); // Kill the connection to the database when you don't need any access to it anymore.
```

Query can also do transactions (SELECT, UPDATE and DELETE since any other will trigger a commit), so you could do multiple operations and if one of them fail, then they will all fails.
```php
$db->transaction([
    "select * from user", [],
    "select id from company where user=? and age=?", ['Arnold', 17 ]
]);
```

You could also just use the `prepare($query, $exec)` function to do anything else you want after that.
```php
$db->prepare("SELECT", function($req) {
 // Do something with your request.
});
```

##### [UsualSQL](#usualsql)

UsualSQL contain some pre-made SQL query to make the work faster.

#### [Routes](#routes)

All routes are made with Bramus.
They're located inside `Server/Routes/Routes.php`, more infos about what you can do for routes are inside [Bramus](https://github.com/bramus/router) documentation.

#### [Validation](#validation)

The validation of all datas comming from the user should be done with [rakit/validation](https://github.com/rakit/validation) inside the controller.