<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 Routes in laravel are defined in following location:

    routes/api.php       -> Routes for url prefixed with /api
    routes/web.php     -> All web routes are defined here

*/


//Basic Routing
Route::get('/basic', function () {
    return '<marquee><h1>Allahu Akber.....</h1></marquee><br> Basic Routing<br>The '.__DIR__.'routes/web.php file defines routes ';
});

/*

Available Router Methods

The router allows you to register routes that respond to any 
HTTP verb(get, post, put, patch, delete, options):

Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);

Sometimes you may need to register a route that responds to
multiple HTTP verbs. You may do so using the match method. Or, 
you may even register a route that responds to all HTTP
verbs using the any method:

Route::match(['get', 'post'], '/', function () {
    //
});

Route::any('/', function () {
    //
});

*/

Route::match(['get', 'post'], '/match', function () {
    return "This is from Match Route";
});

Route::any('/any', function () {
    return "This is from Any Route";
});

/*
Dependency Injection
you may type-hint the Illuminate\Http\Request class to have the current
 HTTP request automatically injected into your route callback:
*/

use Illuminate\Http\Request;

Route::get('/req', function (Request $request) {
    echo "<h1>The contents of Request Variables are as follows:</h1><br>".$request;
});

//Redirect Routes
//By default, Route::redirect returns a 302 status code
Route::redirect('/here', '/basic');

//Or, you may use the Route::permanentRedirect method to 
//return a 301 status code:
Route::permanentRedirect('/per', '/req');

//The view method accepts a URI as its first argument 
//and a view name as its second argument
Route::view('/view', 'myview');

// In addition, you may provide an array of data to pass
// to the view as an optional third argument:

//parameters are reserved by Laravel and cannot be 
//used: view, data, status, and headers.

Route::view('/view_var', 'home' , ['pg_header'=>'Page Header from viw', 'pg_header'=>'Page header' ]);

/*
Route Parameters

Required Parameters

Sometimes you will need to capture segments of the URI within your 
route. For example, you may need to capture a user's ID from the URL.
 You may do so by defining route parameters:
*/
Route::get('/prod/{id}', function ($id) {
    return 'Product ID: '.$id;
});


//You may define as many route parameters as required by your route:

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return "post Id:".$postId." <br>Commentsid:".$commentId;
});

//Route with Controller Method:
use App\Http\Controllers\PostController; // PostController

Route::get('/post', [PostController::class, 'index']);

Route::get('/me', [PostController::class, 'func_me']);

//Route with Parameter:
Route::get('/post/{id}', [PostController::class, 'show']);


/*route with HTML Vervs
Route::get('users', '[UserController::class, 'index']');
Route::post('users', '[UserController::class, 'post']');
Route::put('users/{id}', '[UserController::class, 'update']');
Route::delete('users/{id}', '[UserController::class, 'delete']');
*/

//use Illuminate\Http\Controllers\UserController;
# Defines a routes where id is dynamic 
# Controller must define this $id param as an argument
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/:id', [UserController::class, 'index']);

# Defines a routes where id is optional parameter
Route::get('/users/{id?}', [UserController::class, 'index']);

# Defines a routes where id is required parameter
Route::get('/users/{id}', [UserController::class, 'index']);

/*
How to validate route parameters?

You can also validate route params using regular expression to restrict parameter with certain types.
*/
# Define a route where id should be numeric only
Route::get('/users/{id}', [UserController::class, 'index'])->where('id', '[0-9]+');

# Define a route where name should be alpha only
Route::get('/users/{name}', [UserController::class, 'index'])->where('name', '[A-Za-z]+');

# Define a route where name should be alpha only and id should be numeric only
Route::get('/users/{id}/{name}', [UserController::class, 'index'])->where(['id' => '[0-9]+', 'name' => '[a-z]+']);









/*
 Routes with groups and middlewares

If you decided to group some routes that needs to have certain middlewares attached to them you can easily define them in laravel. Let say that your application has both front and backend.

Only logged in users are allowed to access some urls. You can define a middleware that checks to see if user is logged on or not and then group some routes so that they implement such middleware.

Let's check the following examples:
*/
# Group routes that has middleware that checks to see if user
# Is logged on only logged in users are allowed to access this routes
Route::middleware(['isLoggedIn'])->group(function () {
    Route::get('users', [UserController::class, 'show'])->name('users');
    Route::get('users/:id', [UserController::class, 'index'])->name('user_get');
});

# Group routes that are public only can be accessed without user is logged on
Route::middleware(['web'])->group(function () {
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});


/*
 Define routes with namespaces

If you are working with namespaces and you do not want to bother writing full namespace in every url just like below example:
*/

# Defines all the routes that resides in App/Http/Controllers/User folder
Route::get('users', 'App\Http\Controllers\User\UserController@show')->name('users');
Route::get('users/:id', 'App\Http\Controllers\User\UserController@get')->name('user_get');

/*
If you have more routes that repeats the same patterns you can easily group them using namespace and use them as shown below:
*/

# Defines all the routes that resides in App/Http/Controllers/User folder
Route::namespace('User')->group(function () {
    Route::get('users', [UserController::class, 'show'])->name('users');
    Route::get('users/:id', [UserController::class, 'index'])->name('user_get');
});

/**
 * 
 * Note, we do not need to define whole namespace 
 * if we decide to declare routes using namespace grouping. 
 */

/*
How to add prefix in front of each url?

Using laravel routing you can easily prefix necessary routes and group them together. Consider you are creating admin routes and you want to add admin prefix in all of your routes rather then going to each route and adding the prefix you want to define prefix and group all your routes under that prefix. Later it will be easily to change the prefix in case you decide to prefix /admin with /something.
*/

# Prefix routes with admin and group them together
Route::prefix('admin')->group(function() {
    Route::get('users', [UserController::class, 'show'])->name('users');                //  i.e. admin/users
    Route::get('users/:id', [UserController::class, 'index'])->name('user_get');          //  i.e. admin/users/:id
});

/*
How to get current route name or action or route?

To get current route name or action or url you can use following methods:
*/


# Get current route
$route = Route::current();

# get current route name
$name = Route::currentRouteName();

# get current route controller action
$action = Route::currentRouteAction();

/*
 How to define 404 route?

Using the Route::fallback method, you may define a route that will be executed when no other route matches the incoming request. Say you want to define 404 page when no other routes are matched you can use following route: 
*/
# Define not found route
Route::fallback('HomeController@notFound')->name('notFound');  

# Define 404 route without controller
Route::fallback(function () {
    return view("404");
});

/*
 How to group routes based on sub-domain?

You can group certain routes specific to certain sub domains. 
You can define them as following:
*/

Route::domain('{sub_domain}.isactek.com')->group(function () {
    Route::get('usr/{id}', function ($sub_domain, $id) {
        // your controller logic goes here
        return "from sub domain Route";
    });
});


/*
Route::get('role',[
    'middleware' => 'Role:editor',
    'uses' => [TestController::class, 'index'],
 ]);
*/

 Route::get('/role', [TestController::class, 'index'])
 ->middleware('Role:editor');

 Route::get('/role1', [TestController::class, 'index'])
 ->middleware('Role:Me');
 




 






Route::get('/', function () {
    return view('welcome');
});

Route::get('/tst', function () {
    //return "This is test 1";
    return view('tst');
});

//passing values to view(Blade) bypassing controller
Route::get('/home', function () {
    return view('home', ['pg_title' => 'MKT','pg_header'=>'This is page header']);
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

require __DIR__.'/contact.php';
