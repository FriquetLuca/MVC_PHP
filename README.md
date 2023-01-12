# PHP - MVC template

> A vanilla PHP project with TypeScript and SASS. It's implementend using the Model-View-Controller pattern.

## Index

- [Introduction](#introduction)
- [Guide](#guide)
    - [Installation](#installation)
    - [Development](#development)
    - [Production](#production)
    - [Workflow](#workflow)
        - [Assets](#assets)
        - [Routes](#routes)
        - [Templates](#templates)
        - [Pages](#pages)
        - [Controllers](#controllers)
        - [New content](#new-content)

## [Introduction](#introduction)

This project is made using `NodeJS`, `rsync` and `composer`. You must install all of them to be able to use this project.
It's entire point is to focus on developing pages or API with PHP without bothering with setting up a base.

## [Guide](#guide)

### [Installation](#installation)

The first thing is to install the dependencies.
To do this, just enter the command:
```bash
npm install
composer install
```
Once it's done, you'll have to create a `.env` file in the project's root with the following content:
```
TITLE="The title of your project"
HOST=localhost
PORT=80
USERNAME=your_username
PASSWORD=y0ur_p4$$w0rd
```

- `Title`: It's the title of your project that's gonna be showned in a browser.
- `HOST`: It's your host.
- `PORT`: The port the server listen to.
- `USERNAME`: Your MySQL username.
- `PASSWORD`: Your MySQL password.

### [Development](#development)

The project is already setup for development.
You can use a bunch of `npm run` commands for the project, but there's three specific command to know:

1. `npm run dev`: This command allow you to directly focus on developing. It's going to build the project if it's not already done and run the server. Every changes is going to be detected and TypeScript / SASS files are gonna be transpiled.
2. `npm run build`: Build the project.
3. `npm run start`: Start the server to test the project.

### [Production](#production)

For production, you must change the line `mode: 'development'` in `webpack.config.js` to `mode: 'production'`.
Once it's done, build the project.

### [Workflow](#workflow)

The workflow is divided into multiple parts.

#### [Assets](#assets)

All your assets are located inside `public/assets/`.
You can use `assets` to store your own assets for your project.
Since you won't put code inside `assets` yourself (in theory, since you would probably use TypeScript since the project is made to use it after all), there's two folder you shouldn't touch (except if you know what you're doing): `scripts` and `styles`.
Another rule is that no `public/stylesheets/` folder should exist. It's used in the backgroud as a ghost directory for a temporary storage when there's a need to transpile some SASS content with autoprefixer.

To get your assets from a `src` or `href` in your project, you should use the path: `/assets/myFolder/myFile.myExt`.

#### [Routes](#routes)

Routes are all made with *Bramus Router*, as such, you should consult the documentation for more infos about it.
All routes are located in `Server/Routes/`.

#### [Templates](#templates)

Templates are made in this workflow in a way that it create an HTML structure for your project, then inject some pages into it.
Since you could use multiple templates for a single project, you'll be locating your templates inside the `Server/Views/Templates` directory.
Usually the `bundle.js` would be present inside the template since a template should hold all the project's main components, but you can configure it as you want.

#### [Pages](#pages)

All files inside `Server/Views/Pages` will be your views.
The view is directly inserted inside a template and will be showned depending on how the controller will be set. When making a script or even some style unique to the page, you just need to create a `.scss` or `.ts` file at the same location and with the same name as the page.

#### [Controllers](#controllers)

All controllers files are located inside `Server/Controllers/`.
Controllers can create an access to either a view or an api route.
The view function looks like this:
```php
view($viewName, $datas = [], $template = "index")
```
- The `$viewName` parameter is the relative path from `Server/Views/Pages` to access your view.
- The `$datas` parameter is an array containing a key and a value. Every keyword will be available inside your view as a variable with the associated value.
- The `$template` parameter is the relative path from `Server/Views/Templates` to access the template that's gonna use your view.

#### [New content](#new-content)

To create a view or an api, you need to create some files:
1. Inside the `Server/Routes/Injected/` directory, create a `ExampleRoute.php` file containing:
```php
<?php
$router->get('/example', function() {
    (new ExampleController)->index();
});
```
2. Inside the `Server/Controllers/` directoru, create a `ExampleController.php` file containing:
```php
<?php
use App\Core\Controller;
class ExampleController extends Controller
{
    public function index()
    {
        if($this->isConnected()) {
            // Suppose you're connected, redirect to some page or whatever
        }
        // A call to a view, api works the same
        return $this->view('Example/example', ['varA' => 'valueA', 'varB' => 'valueB', 'varC' => 123]);
    }
}
```
3. Inside the `Server/Views/Pages` (`Server/Views/API` for api), create a directory named `Example` and create a `example.php` file inside it with the following content:
```php
<div>
    <p><?php echo $varA; ?></p>
    <p><?php echo $varB; ?></p>
    <p><?php echo $varC; ?></p>
</div>
```
If you need to style the element (`.scss`) or even add a script (`.ts`) to it, just create a file in the same directory with the same name and it will be automatically linked.