<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([

    'register' => true,
    'reset' => false,
    'verify' => false
]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('quiz/{quizId}', [ExamController::class, 'pertanyaan'])->name('gp');
Route::post('quiz/create', [ExamController::class, 'storeExam'])->name('quiz.create');
// Route::get('quizl/{quizId}', [ExamController::class, 'edit'])->name('quiz.edit');
// Route::patch('quizl/{quizId}', [ExamController::class, 'updateExam'])->name('quiz.update');
Route::get('hasil/user/{userId}/quiz/{quizId}', [ExamController::class, 'hasil'])->name('hasil');


Route::middleware('isAdmin')->group(function () {
    Route::get('admin/index', [QuizController::class, 'index'])->name('home');

    Route::get('admin/create', [QuizController::class, 'create'])->name('create');
    Route::post('admin/index', [QuizController::class, 'store'])->name('store');
    Route::get('admin/{id}/edit', [QuizController::class, 'edit'])->name('edit');
    Route::patch('admin/{id}/edit', [QuizController::class, 'update'])->name('update');
    Route::delete('admin/{id}', [QuizController::class, 'destroy'])->name('destroy');
    Route::get('admin/{id}/show', [QuizController::class, 'pertanyaan'])->name('liat');

    Route::get('admin/pertanyaan/index', [QuestionController::class, 'index'])->name('pertanyaan');
    Route::get('admin/pertanyaan/create', [QuestionController::class, 'create'])->name('created');
    Route::post('admin/pertanyaan/index', [QuestionController::class, 'store'])->name('stored');
    Route::get('admin/pertanyaan/{id}/edit', [QuestionController::class, 'edit'])->name('edited');
    Route::patch('admin/pertanyaan/{id}/edit', [QuestionController::class, 'update'])->name('updated');
    Route::delete('admin/pertanyaan/{id}', [QuestionController::class, 'destroy'])->name('destroyd');
    Route::get('admin/pertanyaan/show/{id}', [QuestionController::class, 'show'])->name('showed');

    // Route::resource('user', [UserController::class]);

    Route::get('user/index', [UserController::class, 'index'])->name('user');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/index', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('user/{id}/edit', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // Route::get('user/show/{id}', [QuestionController::class, 'show'])->name('showed');

    Route::get('exam/index', [ExamController::class, 'userExam'])->name('exam');
    Route::get('exam/assign', [ExamController::class, 'create'])->name('exam.create');
    Route::post('exam/index', [ExamController::class, 'store'])->name('exam.store');

    Route::patch('exam/{id}/edit', [ExamController::class, 'update'])->name('exam.update');
    Route::post('exam/remove', [ExamController::class, 'hapus'])->name('exam.destroy');

    Route::get('hasil', [ExamController::class, 'result'])->name('result');
    Route::get('hasil/{userId}/{quizId}', [ExamController::class, 'userResult'])->name('user.result');
});
