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
#### To link up storage to public
```bash
php artisan storage:link
```
# Laravel Migration
You can create a new database table with this command
### Command
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
# Laravel Migration by Controller
When you want to create and migration by controller you should follow this command

To create migration file include this code on your migration controller
``` bash
Artisan::call('make:migration your_table_name');
```
To run the migrate file include this code on you migration controller
``` bash
Artisan::call('migrate');
```
To clear cache add this code to your controller
``` bash
Artisan::call('cache:clear');
Artisan::call('route:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
```
# Create Laravel Model
### Command
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
# Create Laravel Controller
### Command
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
# Create Laravel Middleware
### Command
```bash
php artisan make:middleware exampleMiddleWare
```
### Code Example
```bash
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('email')){
            return $next($request);
        } else {
            return redirect('/login');
        };
        
    }
}

```
### Login Controller Example
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAdmin;

class LoginController extends Controller
{
    function loginIndex(){
        return view('Login');
    }
    function onLogin(Request $request){
       $email = $request->input('email');
       $password = $request->input('password');
       $userCount = UserAdmin::where('email', '=', $email)->where('password', '=', $password)->count();
       if($userCount==1){
        $request->session()->put('email', $email);
        return 1;
       } else {
        return 0;
       }
    }
    function onLogOut(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}

```
# App Cache Clear
Some cache clear command in mentioned bellow
``` bash 
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
```
# .env File modification
.env file path function
```bash
app()->environmentFilePath();
```
get .env file as string function
```bash
file_get_contents();
```
To add a new line at last of the .env string apply this
```bash 
$envString = file_get_contents($envPathLocation);
$envString.="\n";
```
Get the string position function
```bash
strpos(string,find,start)
```
string(required) specifies the string to search.<br> find(required) Specifies the string to find and <br>start(optional) parameter Specifies where to begin the search. If start is a negative number, it counts from the end of the string.

Cut a string. The substr() function returns a part of a string.
```bash
substr(string,start,length)
```
string(required) Specifies the string to return a part of. start(required) Specifies where to start in the string. length(optional) Specifies the length of the returned string. Default is to the end of the string.

String replace function str_replace();
```bash 
str_replace(find,replace,string,count);
```
find(Required) Specific value to find<br>
replace(Required) Specifies the value to replace the value in find<br>
string(Required). Specifies the string to be searched<br>
count(optional). A variable that counts the number of replacements

file_put_contents(); function to write the string
```bash 
file_put_contents(filename, data, mode, context)
```
filename(Required) Specifies the path to the file to write to. If the file does not exist, this function will create one<br>

data (Required) The data to write to the file. Can be a string, array, or a data stream<br>

mode (Optional) Specifies how to open/write to the file. Possible values:<br>
- FILE_USE_INCLUDE_PATH - search for filename in the include directory
- FILE_APPEND - if file already exists, append the data to it instead of overwriting it
- LOCK_EX - Put an exclusive lock on the file while writing to it

context (Optional) Specifies the context of the file handle. Context is a set of options that can modify the behavior of a stream.
## Global function to modify .env file example
```bash
function SetEnvVal($envKey, $envValue){
       $envFilePath = app()->environmentFilePath();
       $envByString = file_get_contents($envFilePath);
        // Create a new line at last of the .env string
        $envByString.="\n";
        // Get String Position
        $keyStartPos = strpos($envByString, "{$envKey}=");
        $keyEndingPos = strpos($envByString, "\n", $keyStartPos);
        $oldValue = substr($envByString, $keyStartPos, $keyEndingPos-$keyStartPos);

        if(!$keyStartPos || !$keyEndingPos || !$oldValue){
            $envByString.="{$envKey}={$envValue}\n";
        } else {
            $envByString = str_replace($oldValue, "{$envKey}={$envValue}", $envByString);
        }
        $envByString = substr($envByString, 0, -1);
        $changingResult = file_put_contents($envFilePath, $envByString);
        if(!$changingResult){
            return false;
        } else {
            return true;
        }
    }

    function EnvConfig(){
        $this->SetEnvVal('DB_DATABASE', 'my_database');
        $this->SetEnvVal('DB_USERNAME', 'my_user');
        $this->SetEnvVal('DB_PASSWORD', '28428927');

        $this->SetEnvVal('ON_SIGNAL_API_KEY', '2424354654754736');
        $this->SetEnvVal('SMS_API_KEY', '457346347537355673');
        $this->SetEnvVal('SMS_API_USER', '35634563453');
        $this->SetEnvVal('SMS_API_PASS', '563634645645');
    }
```
## PHP Configuration Check function
```bash
 function serverConfigCheck(){
        $phpVersion = phpversion();
        $bcmath = extension_loaded('bcmath');
        $ctype = extension_loaded('ctype');
        $fileInfo = extension_loaded('fileinfo');
        $json = extension_loaded('json');
        $mbString = extension_loaded('mbstring');
        $openSSL = extension_loaded('openssl');
        $tokenizer = extension_loaded('tokenizer');
        $xml = extension_loaded('xml');
        $pdo = defined('PDO::ATTR_DRIVER_NAME');
        if($phpVersion >= 7.2 && $bcmath == true && $ctype == true && $fileInfo == true && $json == true && $mbString == true && $openSSL == true && $tokenizer == true && $xml == true && $pdo == true){
            return "Laravel 7x Supported";
        } else {
            return  "Laravel 7x ont Supported";
        }
    }
```
phpversion() function is for to check the current php version.<br>
extension_loaded(extension) function is for find out whether an extension is loaded.<br>
extension(required) The extension name. This parameter is case-insensitive.

You can see the names of various extensions by using phpinfo() or if you're using the CGI or CLI version of PHP you can use the -m switch to list all available extensions:<br>
$ php -m<br>
[PHP Modules]<br>
xml<br>
tokenizer<br>
standard<br>
sockets<br>
session<br>
posix<br>
pcre<br>
overload<br>
mysql<br>
mbstring<br>
ctype
# Routing System on Laravel 8
There some changes on Routing System in Laravel 8
```bash
Route::get('/', [ControllerName::class, 'FunctionName']);
```
Note: You should add the Controller file manually.
```bash
use App\Http\Controllers\ControllersName;
```
# Data Call with axios
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
# Data call with axios by id
### Code Example
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
# Data Update with axios
### Code Example
```bash
function serviceUpdate(id, serviceName, serviceDescription, imageLink){
    if(serviceName.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service name is empty');
   } else if(serviceDescription.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service description is empty');
   } else if(imageLink.length==0){
       $('#error-notifications').toast('show');
       $('#error-notifications .error-msg').html('Service image is empty');
   } else {
       $('.saveChange-btn').html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>');
       axios.post('/updateServiceData', {
           id: id,
           serviceName: serviceName,
           serviceDescription: serviceDescription,
           imageLink: imageLink
       })
       .then(function(response){
           $('.saveChange-btn').html('Save Change');
           if(response.status==200){
               if(response.data == 1){
                   getServicesData();
                   $('#editModal').modal('hide');
                   $('#success-notifications').toast('show');
                   $('#success-notifications h5').html('Update Successful');
               } else {
                   getServicesData();
                   $('#editModal').modal('hide');
                   $('#error-notifications').toast('show');
                   $('#error-notifications .error-msg').html('Update Fail'); 
               }
           } else {
               $('#editModal').modal('hide');
               $('#error-notifications').toast('show');
               $('#error-notifications .error-msg').html('Something went wrong !');  
           }

       })
       .catch(function (error) { 
           $('#editModal').modal('hide');
           $('#error-notifications').toast('show');
           $('#error-notifications .error-msg').html('Something went wrong !');
        });
   }
}
```
# Data Delete with axios
### Code Example
```bash
function dataServiceDelete(deleteId) {
    $('.service-dlt-btn').html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
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
            $('#deleteModal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications .error-msg').html('Something went wrong !');
        });
}
```
# Data Insert() with axios
### Code Example
```bash
$('#addNewData').click(function(){
    var clientName = $('#addClientName').val();
    var feedback = $('#addFeedback').val();
    var clientPhoto = $('#clientPhoto').val();
    if(clientName.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Name Field is Empty');
    } else if(feedback.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Feedback Field is Empty'); 
    } else if(clientPhoto.length == 0){
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Photo Field is Empty'); 
    } else {
        $('#addNewReview').html('<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>');
        axios.post('/add_new_review', {
            'clientName': clientName, 
            'clientFeedback': feedback,
            'clientPhoto': clientPhoto
        })
        .then(function(response){
            if(response.data == 1){
                $('#addNewReview').html('Add');
                $('#addClientName').val('');
                $('#addFeedback').val('');
                $('#clientPhoto').val('');
                getReviewData();
                $('#add-new-review-modal').modal('hide');
                $('#success-notifications').toast('show');
                $('#success-notifications h5').html('Review added successfully');
            } else {
                $('#addNewReview').html('Add');
                $('#add-new-review-modal').modal('hide');
                $('#error-notifications').toast('show');
                $('#error-notifications h5').html('Review added fail'); 
            }
        })
        .catch(function (error) { 
            $('#addNewReview').html('Add');
            $('#add-new-review-modal').modal('hide');
            $('#error-notifications').toast('show');
            $('#error-notifications h5').html('Review added fail'); 
         })
    }
});

```
# jQuery serializeArray() method
With serializeArray() method you can get form data.
### Code Example
```bash
<script type="text/javascript">
    $('.login-form').on('submit', function(event){
        event.preventDefault();
        let FormData = $(this).serializeArray();
        let userName = FormData[0]['value'];
        let password = FormData[1]['value'];
    })
</script>
```
# jQuery Image Preview function 
First you need to take Html input type 
### Code Example
```bash
<input type="file" id="image-input" class="form-control" />
<img src="" alt="" id="image-preview" style="max-width: 100%">
```
Now run an event to see the Image
### Code Example
```bash
$('#image-input').change(function(){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function(event){
            var imgSource = event.target.result;
            $('#image-preview').attr('src', imgSource);
        }
});
```
# Image upload full jQuery and Laravel Controller Code
### jQeury Code Example
```bash
<script type="text/javascript">
    $('#add-new').click(function(){
        $('#add-new-modal').modal('show');
    });
    $('#image-input').change(function(){
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function(event){
            var imgSource = event.target.result;
            $('#image-preview').attr('src', imgSource);
        }
    });
    $('#upload-image').on('click', function(){
      $(this).html('<div class="spinner-border text-light" style="font-size: 12px" role="status"><span class="visually-hidden">Loading...</span></div>')
      var imageFile = $('#image-input').prop('files')[0];
      var formData = new FormData();
      formData.append('image', imageFile);
      axios.post('/image_upload', formData)
      .then(function(response){
        if(response.status==200){
          $('#upload-image').html('Add');
          $('#add-new-modal').modal('hide');
          $('#success-notifications').toast('show');
          $('#success-notifications h5').html('Upload Successfull');
        } else {
          $('#upload-image').html('Add');
          $('#add-new-modal').modal('hide');
          $('#error-notifications').toast('show');
          $('#error-notifications h5').html('Something went wrong');
        }
      })
      .catch(function(error){
        $('#upload-image').html('Add');
        $('#add-new-modal').modal('hide');
        $('#error-notifications').toast('show');
        $('#error-notifications h5').html('Upload Fail');
      })
    })
  
</script>
```
### Laravel Controller Code
```bash
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryModel;

class Gallery extends Controller
{
    function galleryIndex(){
        return view('Gallery');
    }
    function uploadImage(Request $request){
       $imagePath = $request->file('image')->store('public');
       $imageName = (explode('/', $imagePath))[1];
       $host = $_SERVER['HTTP_HOST'];
       $imageUrl = $host. "/storage/". $imageName;
       $result = GalleryModel::insert(['image_path'=>$imageUrl]);
       return $result;
    }
}

```
# Laravel Function
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
        $VisitorData = VisitorModel::orderBy('id', 'desc')->limit(3)->get();
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
# 17. @foreach()
This function use for loop of the data
### Code Example
```bash
        @foreach($servicesData as $servicesData)
            <div class="col-md-3 p-2 ">
                <div class="card service-card text-center w-100">
                    <div class="card-body">
                        <img class="service-card-logo " src="{{$servicesData->service_img}}" alt="Card image cap">
                        <h5 class="service-card-title mt-3">{{$servicesData->service_name}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0">{{$servicesData->service_des}}</h6>
                    </div>
                </div>
            </div>
        @endforeach
```
# 18. limit()
Mention how many data you want to get
### Code Example
```bash
function HomeIndex(){
        $userIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date('Y-m-d h:i:sa');
        VisitorModel::insert(['ip_address'=>$userIP, 'visit_time'=>$timeDate]);
        $servicesData = servicesModel::all();
        $courseData = CourseModel::orderBy('id', 'desc')->limit(6)->get();
        return view('Home', [
            'servicesData'=>$servicesData,
            'courseData'=>$courseData
        ]);


}
```
# 19. count()
With this function you can count the database table row easily. Just select the model
### Code Example
```bash
class HomeController extends Controller
{
   function HomeIndex(){
      $TotalCourse = CourseModel::count();
      $TotalProject = ProjectModel::count();
      $TotalReview = ReviewModel::count();
      $TotalServices = servicesModel::count();
      $TotalVisitor = VisitorModel::count();
      $TotalContact = MessageModel::count();
        return view('Home', [
         'TotalCourse'=>$TotalCourse,
         'TotalProject'=>$TotalProject,
         'TotalReview'=>$TotalReview,
         'TotalServices'=>$TotalServices,
         'TotalVisitor'=>$TotalVisitor,
         'TotalContact'=>$TotalContact
        ]);
   }
   
}
```
# 20. explode()
with explode() function you can divide a string
### Code Example
```bash
 function uploadImage(Request $request){
       $imagePath = $request->file('image')->store('public');
       $imageName = (explode('/', $imagePath))[1];
       $host = $_SERVER['HTTP_HOST'];
       $imageUrl = $host. "/storage/". $imageName;
       GalleryModel::insert(['image_path'=>$imageUrl]);
       return $imageName;
    }
}
```
