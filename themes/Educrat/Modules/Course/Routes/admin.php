<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'section'],function (){
    Route::get('getForSelect2','SectionController@getForSelect2')->name('course.admin.section.lesson.getForSelect2');
    Route::get('getSectionForSelect2','SectionController@getSectionForSelect2')->name('course.admin.section.getForSelect2');
});


Route::group(['prefix'=>'detail/{id}',],function (){
    Route::get('/lessons','LessonController@index')->name('course.admin.lesson.index');
    Route::post('/lessons/store','LessonController@store')->name('course.admin.lesson.store');
    Route::post('/lessons/delete','LessonController@delete')->name('course.admin.lesson.delete');

    Route::post('/sections/store','SectionController@store')->name('course.admin.section.store');
    Route::post('/sections/delete','SectionController@delete')->name('course.admin.section.delete');
});
