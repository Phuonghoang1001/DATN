<?php

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

Route::get('admin/login', 'userController@getLoginAdmin');
Route::post('admin/login', 'userController@postLoginAdmin');
Route::get('admin/logout', 'userController@getLogoutAdmin');

Route::group(['prefix' => 'admin', 'middleware'=>'adminLogin'], function () {
    Route::group(['prefix' => 'lesson'], function () {
        Route::get('list', 'lessonController@getList');
        Route::get('add', 'lessonController@getAdd');
        Route::post('add', 'lessonController@postAdd');
        Route::get('edit/{id}', 'lessonController@getEdit');
        Route::post('edit/{id}', 'lessonController@postEdit');
        Route::get('delete/{id}', 'lessonController@getDelete');
        Route::post('import_data', 'lessonController@postImportData');

    });
    Route::group(['prefix' => 'lesson_detail'], function () {
        Route::get('list', 'LessonDetaiController@getList');
        Route::get('add', 'LessonDetaiController@getAdd');
        Route::post('add', 'LessonDetaiController@postAdd');
        Route::get('edit/{id}', 'LessonDetaiController@getEdit');
        Route::post('edit/{id}', 'LessonDetaiController@postEdit');
        Route::get('delete/{id}', 'LessonDetaiController@getDelete');
    });

    Route::group(['prefix' => 'question_test'], function () {
        Route::get('list', 'QuestionTestController@getList');
        Route::get('add', 'QuestionTestController@getAdd');
        Route::post('add', 'QuestionTestController@postAdd');
        Route::get('edit/{id}', 'QuestionTestController@getEdit');
        Route::post('edit/{id}', 'QuestionTestController@postEdit');
        Route::get('delete/{id}', 'QuestionTestController@getDelete');
        Route::post('import_data', 'QuestionTestController@postImportData');
    });
    Route::group(['prefix' => 'question_comment'], function () {
        Route::get('list', 'QuestionCommentController@getList');
        Route::get('add', 'QuestionCommentController@getAdd');
        Route::post('add', 'QuestionCommentController@postAdd');
        Route::get('edit/{id}', 'QuestionCommentController@getEdit');
        Route::post('edit/{id}', 'QuestionCommentController@postEdit');
        Route::get('delete/{id}', 'QuestionCommentController@getDelete');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'userController@getList');
        Route::get('login', 'userController@getLogin');
        Route::post('login', 'userController@postLogin');
        Route::get('logout', 'userController@getLogout');
        Route::get('register', 'userController@getRegister');
        Route::post('register', 'userController@postRegister');
        Route::get('edit/{id}', 'userController@getEdit');
        Route::post('edit/{id}', 'userController@postEdit');
    });
});


Route::get('home', 'pageController@home');
Route::get('lesson/{id}.html', 'pageController@lesson');
Route::group(['middleware'=>'login'], function(){
    Route::get('test/{id}.html', 'pageController@test');
    Route::get('tests/{test_id}/load_question.html', 'pageController@loadQuestion');
    Route::post('test/{id}.html', 'pageController@postAnswer');
    Route::post('comment/{id}.html','pageController@postComment');
});

Route::get('login','pageController@getLogin');
Route::get('logout','pageController@getLogout');
Route::post('login','pageController@postLogin');
Route::get('register','pageController@getRegister');
Route::post('register','pageController@postRegister');
Route::group(['prefix' => 'user','middleware'=>'login'], function () {
    Route::get('myAccount', 'userPageController@getInfoAccount');
    Route::post('edit', 'userPageController@postEditAccount');

    Route::get('lesson_followed', 'userPageController@getLessonFollowed');
    Route::post('lesson_followed', 'userPageController@postLessonFollowed');
    Route::get('lesson_followed_add/{lesson_id}', 'userPageController@getLessonFollowedAdd');
    Route::get('lesson_followed_delete/{lesson_id}', 'userPageController@getLessonFollowedDelete');

    Route::get('lesson_favourite', 'userPageController@getLessonFavourite');
    Route::post('lesson_favourite', 'userPageController@postLessonFavourite');
    Route::get('lesson_favourite_add/{lesson_id}', 'userPageController@getLessonFavouriteAdd');
    Route::get('lesson_favourite_delete/{lesson_id}', 'userPageController@getLessonFavouriteDelete');

    Route::get('myComment', 'userPageController@getMyComment');
    Route::post('myComment', 'userPageController@postMyComment');

    Route::get('myTestList', 'userPageController@getMyTestList');
    Route::get('myTestDetail/{id}', 'userPageController@getMyTestDetail');
});
