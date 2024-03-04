<?php
// require 'vendor/autoload.php';

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::resource('posts',PostController::class);

Route::get('create/{count}', function($count){
    DatabaseSeeder::create($count);
    return "Created {$count} records";
});

Route::middleware('auth')->group(function(){
    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');

    Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles');
    Route::post('/admin/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/admin/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/admin/roles/{id}/edit',[RoleController::class , 'edit'])->name('roles.edit');
    Route::put('/admin/roles/{role}' ,[RoleController::class , 'update'])->name('roles.update');

    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/admin/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/admin/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/admin/permissions/{id}/edit',[PermissionController::class , 'edit'])->name('permissions.edit');
    Route::put('/admin/permissions/{permission}' ,[PermissionController::class , 'update'])->name('permissions.update');


});

Route::get('test/gate', function(){
    if (Gate::allows('access-admin')) {
        echo 'Welcome to the admin section';
    } else {
        echo 'You shall not pass';
    }
});


// Route::get('/posts/{post}/edit' , [PostController::class,'edit'])->middleware('can:update,post')->name('posts.edit');

Route::get('user/profile/{id}', [UserController::class,'profileshow'])->middleware('auth')->name('user.profile');


Route::post('/search/post', [PostController::class, 'searchpost'])->name('post.search');

// Route::post('/search/post', function(Request $request){
//     dd($request);
// });

Route::patch('/user/update/{id}' , [UserController::class , 'update'])->name('user.update');

Route::get('/users/displayall' , [UserController::class, 'index'])->middleware('auth','role:admin')->name('users.index');

Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->middleware('auth','role:admin')->name('users.destroy');

Route::get('/user/post/display/{id}', [UserController::class,'showuserposts'])->middleware('auth')->name('users.posts.display');

Route::get('/user/roles/update/{id}',[UserController::class, 'userRolesUpdate'])->name('users.roles.update');

Route::get('/user/profile/preview/{id}',[UserController::class , 'getUserPreview'])->name('users.show.preview');

// Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles');
// Route::get('/admin/roles/store', [RoleController::class, 'store'])->name('roles.store');
// Route::delete('/admin/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
// Route::get('/admin/roles/{id}/edit',[RoleController::class , 'edit'])->name('roles.edit');
// Route::put('/admin/roles/{role}' ,[RoleController::class , 'update'])->name('roles.update');

// Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permissions');
// Route::get('/admin/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
// Route::delete('/admin/permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
// Route::get('/admin/permissions/{id}/edit',[PermissionController::class , 'edit'])->name('permissions.edit');
// Route::put('/admin/permissions/{permission}' ,[PermissionController::class , 'update'])->name('permissions.update');


Route::get('/category/posts/{name}', [CategoryController::class, 'categoryPosts'])->name('category.posts');

Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/show', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/category/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/category/{id}/edit/', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/category/{category}/update/', [CategoryController::class, 'update'])->name('categories.update');

Route::post('/post/{id}/comment/store', [PostCommentController::class,'store'])->name('comments.store');
Route::post('/comment/{id}/reply/store', [CommentReplyController::class,'store'])->name('commentreplies.store');


Route::get('/comments/recieved', [PostCommentController::class, 'index'])->name('comments.index');
Route::delete('/comment/{id}/delete', [PostCommentController::class,'destroy'])->name('comments.destroy');
Route::PATCH('/comment/{id}/update', [PostCommentController::class,'update'])->name('comments.update');
Route::patch('/comment/ajaxupdate', [PostCommentController::class,'ajaxUpdate'])->name('comments.ajaxupdate');

Route::get('/comment/{id}/replies', [CommentReplyController::class, 'index'])->name('commentReplies.index');
Route::delete('/comment/reply/{id}/delete', [CommentReplyController::class,'destroy'])->name('commentReplies.destroy');
Route::PATCH('/comment/reply/{id}/update', [CommentReplyController::class,'update'])->name('commentReplies.update');
Route::patch('/comment/reply/ajaxupdate', [CommentReplyController::class,'ajaxUpdate'])->name('commentReplies.ajaxupdate');

// tinymce
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    });


Route::get('download/excel',function(){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $cats = Category::get();

    $sheet->setCellValue('A1','Hello World !');
    $sheet->setCellValue('B1','Hello World !');
    $sheet->setCellValue('C1','Hello World !');
    $sheet->setCellValue('D1','Hello World !');

    $rowno = 2;
    foreach($cats as $cat){
        $sheet->setCellValue('A'.$rowno,$cat["id"]);
        $sheet->setCellValue('B'.$rowno,$cat["name"]);
        $sheet->setCellValue('C'.$rowno,$cat["created_at"]);
        $sheet->setCellValue('D'.$rowno,$cat["updated_at"]);

        $rowno++;
    }


    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world11.xlsx');
    return response()->download(public_path('hello world11.xlsx'));
});

Route::get('/upload/excel',[FileController::class,'uploadFile']);