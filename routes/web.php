<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post/create', [HomeController::class, 'create'])->name('post.create');
Route::post('/post', [HomeController::class, 'store'])->name('post.store');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Route::get('/contact123', function() {
//     return view('contact');
// });

// Route::post('/send', function() {
//     if (!empty($_POST)) {
//         dump($_POST);
//     }
//     return '<h1> SEND </h1>';
// })->name('senddd');

Route::match(['post', 'get'], '/contact', function(){
    if (!empty($_POST)) {
        dump($_POST);
        }
    return view ('contact');
})->name('senddd');

Route::get('/hello/{id}/{slug?}', function (string $id, $slug = null) {
    return "<h1> hello . $id . | $slug </h1>";
});
//->where(['id' => '[0-9]+', 'slug' => '[A-Za-z]+']);

Route::get('/hello/hello', function () {
    return '<h1> hello.hello </h1>';
});


Route::prefix('admin')->group(function() {
    Route::get('/posts', function() {
        return 'Posts List';
    });
    Route::get('/posts/create', function() {
        return 'Posts Create';
    });
    Route::get('/posts/{id}/edit', function($id) {
        return "Edit Post $id";
    });
});

Route::redirect('/contact', '/', 301);

Route::fallback(function() {
    // return redirect()->route('senddd');
    abort(404, 'Page not found');
});
