<?php

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

Route::middleware(['guest'])->group(function () {
    Route::get('/register', 'UserController@create')->name('register.create'); // показываем форму
    Route::post('/register', 'UserController@store')->name('register.store'); // принимаем данные из формы  
    Route::get('/login/create', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});
Route::get('/login', 'UserController@logout')->name('logout')->middleware('auth');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/rubric/{rubric}', 'HomeController@index')->name('postsByRubrics'); //статьи по категориям
Route::get('/create', 'HomeController@create')->name('posts.create')->middleware('auth'); // показывает форму создания
Route::post('/', 'HomeController@store')->name('posts.store'); // сохраняет данные из формы
Route::get('/posts/{id}', 'HomeController@showPost')->name('showPost'); // показывает пост
Route::get('/posts/{id}/update', 'HomeController@updatePost')->name('updatePost');
Route::post('/posts/{id}/update', 'HomeController@updatePostCreate')->name('updatePostCreate');
Route::get('/posts/{id}/delete', 'HomeController@deletePost')->name('deletePost');
// Route::post(/get)

Route::get('/page/about', 'PageController@show')->name('page.about');

// Route::get('/send', 'ContactController@send');
Route::match(['get', 'post'], '/send', 'ContactController@send')->name('send');



Route::group(['admin' => 'admin', 'prefix' => 'admin', 'namespace' => 'admin'], function () {
    Route::get('/', 'MainController@index')->middleware('admin'); // 1 argument in app\http\kernel.php (name of middleware)
});


// Route::get('/admin', 'Admin\MainController@index')->middleware('admin'); // 1 argument in app\http\kernel.php (name of middleware)







































































































/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
     return '<h1>Hello, world!</h1>';
});*/

// Route::get('/', function () {
//     $res = 2 + 3;
//     $name = 'John';
//     return view('home', compact('res', 'name'));
//     //    return view('home', ['res' => $res, 'name' => $name]);
// })->name('home');

// Route::get('/about', function () {
//     return '<h1>About Page</h1>';
// });

/*Route::get('/contact', function () {
    return view('contact');
});

Route::post('/send-email', function () {
    if(!empty($_POST)){
        dump($_POST);
    }
    return 'Send Email';
});*/

/*Route::match(['post', 'get'], '/contact', function () {
    if(!empty($_POST)){
        dump($_POST);
    }
    return view('contact');
});*/

// Route::match(['post', 'get', 'put'], '/contact', function () {
//     if (!empty($_POST)) {
//         dump($_POST);
//     }
//     return view('contact');
// })->name('contact');

// Route::view('/test', 'test', ['test' => 'Test data']);

//Route::redirect('/about', '/contact');
//Route::redirect('/about', '/contact', 301);
// Route::permanentRedirect('about', 'contact');

/*Route::get('/post/{id}', function ($id) {
    return "Post $id";
});*/

/*Route::get('/post/{id}/{slug}', function ($id, $slug) {
    return "Post $id | $slug";
})->where(['id' => '[0-9]+', 'slug' => '[A-Za-z0-9-]+']);*/

// Route::get('/post/{id}/{slug?}', function ($id, $slug = null) {
//     return "Post $id | $slug";
// })->name('post');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/posts', function () {
//         return 'Posts List';
//     });

//     Route::get('/post/create', function () {
//         return 'Post Create';
//     });

//     Route::get('/post/{id}/edit', function ($id) {
//         return "Edit Post $id";
//     })->name('post');
// });

// Route::get('/', 'HomeController@index');
// Route::get('/test', 'HomeController@test');
// Route::get('/test2', 'Test\TestController@index');
// Route::get('/page/{slug}', 'PageController@show');

// Route::resource('/admin/posts', 'PostController', ['parameters' => [
//     'posts' => 'slug'
// ]]);

// Route::fallback(function () {
//     //    return redirect()->route('home');
//     abort(404, 'Oops! Page not found...');
// });