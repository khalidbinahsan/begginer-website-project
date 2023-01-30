# Essential Command
#### To create a new project and install laravel
```bash
composer create-project --prefer-dist laravel/laravel folder-name
```
#### To run the project
```bash
php artisan serve
```
#### To run the project by setting a port
```bash
php artisan serve --port=8080
```
#### To Create a DB table
```bash
php artisan make:migration MigrationName
```
### Code Example
```bash
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VisitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('ip_address');
            $table->string('visit_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

```
#### To make a Model
```bash
php artisan make:Model ModelName
```
### Code Example
```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    use HasFactory;
    public $table='visitor';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}

```
Note: After Creating Migration and Model file you should run migration command to create the table and column
```bash
php artisan migrate
```
#### To make a Controller
```bash
php artisan make:controller ControllerName
```
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelFileName;
class HomeController extends Controller
{
    function HomeIndex(){
        return view('Home');
    }
}

```
Note: You should add Model file to Controller file manually.
```bash
use App\Models\ModelFileName;
```
# Routing System on Laravel 8
There some changes on Routing System in Laravel 8
```bash
Route::get('/', [ControllerName::class, 'FunctionName']);
```
Note: You should add the Controller file manually.
```bash
use App\Http\Controllers\ControllersName;
```
# Data Called by axios js
To call your database file by axios js you should write some js code into your public/custom.js file.
### Code Example
```bash 
function getServicesData() {
    axios.get('/getServicesData')
        .then(function(response) {
            var jsonData = response.data;
            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    '<td><img class="table-img" src="' + jsonData[i].service_img +
                    '"></td><td>' + jsonData[i].service_name +
                    '</td><td>' + jsonData[i].service_des +
                    '</td><td><a href="" ><i class="fas fa-edit"></i></a></td><td><a href="" > <i class="fas fa-trash-alt"></i></a></td>').appendTo('#service_table');
            });
        })
        .catch(function(error) {

        });

}
```
#Data call with axios by id
###Code Example
```bash
function dataServiceDelete(deleteId) {
    axios.post('/deleteService', { id: deleteId })
        .then(function(response) {
            $('.service-dlt-btn').html('DELETE');
            if (response.data == 1) {
                getServicesData();
                $('#deleteModal').modal('hide');
                $('#success-notifications').toast('show');           
            } else {
                getServicesData();
                $('#deleteModal').modal('hide');
                $('#error-notifications').toast('show');
                
            }
        })
        .catch(function(error) {
           // Do something for error control
        });
}
```
# Using Function
 ## 1. {{asset()}}
This Function help you to link up your external css, js or img file

### Example:
```bash 
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" >
```
## 2. {{url()}}
This function use for set a href link on anchor tag.
### Example
```bash 
<a href="{{url('/visitor')}}">Visitor</a>
```
## 3. @yield()
This Function use to grab your content
### Example:
```bash
@yield('content')
@yield('title')
```
## 4. @include()
With this you can add any Layout into your page
### Example:
```bash 
@include('Layout.menu')
```
Here Layout is folder name and menu is file name.
## 5. @extends()
To marge your on page to another you should do it with this function. Suppose you want to grab your header and footer from the master Layout folder, so you can do this with @extends function
### Example:
```bash
@extends('Layout.app')
```
Here the Layout is folder name and app is the file name.
## 6. $_SERVER['REMOTE_ADDR']
By this function you can get the ip address of your site visitor.
## 7. date_default_timezone_set('Asia/Dhaka')
To set your default time zone
## 8. date('Y-m-d h:i:sa')
To set your time format
## 9. json_decode()
When you get all of your data from table by all() function, it actually store by a json file. so if you want to get it by arrow types you should decode it by this function. This function contain parameter. so when you give a parameter like 'ture' so the data will store by a associative array. Default value is False. 
Note: In laravel latest version no need to encode json data
## 10. json_encode()
So if you want to get your database Data with javascript, you should get as a json file to complete it with ajax request.
### Example
```bash
$result = json_encode(Modelname::all());
```
Note: in moder laravel version no need to use this. The Data come as a json file in latest laravel version
## 11. inset()
By this function you can inset your data into database to a particular column.
### Code Example
```bash 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $userIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date('Y-m-d h:i:sa');
        VisitorModel::insert(['ip_address'=>$userIP, 'visit_time'=>$timeDate]);

        return view('Home');
    }
}

```
## 12. all() get all data from database
Get your all data from database through array();
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function VisitorList(){
        $VisitorData = VisitorModel::all();
        // when you want to pass a variable value by a view you should set a key and it's value.
        return view('Visitor', ['VisitorData' => $VisitorData]);
    }
}

```
## 13.get() get only 3 data from database
if you want to get particular number of data, you can use this function
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function VisitorList(){
        $VisitorData = VisitorModel::orderBy('id', 'desc')->take(3)->get();
        // when you want to pass a variable value by a view you should set a key and it's value.
        return view('Visitor', ['VisitorData' => $VisitorData]);
    }
}

```
## 14. where() Get data by id 
with where() function you can get your data by id
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
    function getDataById(Request $req){
        $id = $req->input('id');
        $result = servicesModel::where('id', '=', $id)->get();
        return $result;
    }
}
```
## 15. delete() Delete data from database
delete your data from database with this function
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
      function deleteServiceData(Request $req){
        $id = $req->input('id');
        $result = servicesModel::where('id', '=', $id)->delete();
        if($result==true){
            return 1;
        } else {
            return 0;
        }
    }
}
```
## 16. update() update your existing data with new one
### Code Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;

class VisitorController extends Controller
{
       function serviceUpdate(Request $req){
        $id = $req->input('id');
        $serviceName = $req->input('serviceName');
        $serviceDescription = $req->input('serviceDescription');
        $imageLink = $req->input('imageLink');
        $result = servicesModel::where('id', '=', $id)->update(['service_name'=>$serviceName, 'service_des'=> $serviceDescription, 'service_img'=> $imageLink]);
        if($result == true){
            return 1;
        } else {
            return 0;
        }
}
```

