# Essential Command
#### To create a new project and install laravel
```bash
composer create-project --prefer-dist laravel/laravel folder-name
```
#### To run the project
```bash
php artisan serve
```
####To run the project by setting a port
```bash
php artisan serve --port=8080
```
# Using Function
 ## 1. {{asset}}
This Function help you to link up your external css, js or img file

### Example:
```bash 
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" >
```
## 2. @yield()
This Function use to grab your content
### Example:
```bash
@yield('content')
@yield('title')
```
## 3. @include()
With this you can add any Layout into your page
### Example:
```bash 
@include('Layout.menu')
```
Here Layout is folder name and menu is file name.
## 4. @extends()
To marge your on page to another you should do it with this function. Suppose you want to grab your header and footer from the master Layout folder, so you can do this with @extends function
### Example:
```bash
@extends('Layout.app')
```
Here the Layout is folder name and app is the file name.