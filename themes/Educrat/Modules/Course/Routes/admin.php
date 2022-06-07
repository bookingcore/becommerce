<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'section'],function (){
    Route::get('getForSelect2','SectionController@getForSelect2')->name('course.admin.section.lesson.getForSelect2');
    Route::get('getSectionForSelect2','SectionController@getSectionForSelect2')->name('course.admin.section.getForSelect2');

    Route::get('{course_id}/index','SectionController@index')->name('course.admin.section.index');
    Route::get('{course_id}/edit/{id}','SectionController@edit')->name('course.admin.section.edit');
    Route::post('{course_id}/store/{id}','SectionController@store')->name('course.admin.section.store');
    Route::post('{course_id}/editSectionBulk','SectionController@editSectionBulk')->name('course.admin.section.editSectionBulk');

    Route::get('{course_id}/lessons/{id}','SectionController@lessons')->name('course.admin.section.lesson.index');
    Route::get('{course_id}/lesson_edit/{id}','SectionController@lesson_edit')->name('course.admin.section.lesson.edit');
    Route::post('{course_id}/editLessonBulk','SectionController@editLessonBulk')->name('course.admin.section.lesson.editLessonBulk');
    Route::post('{course_id}/lesson_store','SectionController@lesson_store')->name('course.admin.section.lesson.store');
});


Route::group(['prefix'=>'detail/{id}',],function (){
    Route::get('/lessons','LessonController@index')->name('course.admin.lesson.index');
    Route::post('/lessons/store','LessonController@store')->name('course.admin.lesson.store');
    Route::post('/sections/store','SectionController@store_ajax')->name('course.admin.section.store');
});
