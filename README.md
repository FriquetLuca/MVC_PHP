# PHP - MVC template

> A vanilla PHP project with TypeScript and SASS. It's implementend using the Model-View-Controller pattern.

## Index

- [Introduction](#introduction)
- [Guide](#guide)
    - [Installation](#installation)
    - [Development](#development)
    - [Production](#production)
    - [Workflow](#workflow)

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

#### [Templates](#templates)

Templates are made in this workflow in a way that create an HTML structure for your project, then inject some view into it.
Since you could use multiple templates for a single project, you'll be locating your templates inside the `Server/Views/Templates` directory.
