<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryFormController;
use App\Http\Controllers\Api\CategoryFormScoreNormController;
use App\Http\Controllers\Api\CategoryQuestionController;
use App\Http\Controllers\Api\CategoryUserController;
use App\Http\Controllers\Api\CategoryUserMainsController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\FormCompleteController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\FormSectionController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionOptionController;
use App\Http\Controllers\Api\QuestionOptionItemController;
use App\Http\Controllers\Api\ResultsTestByClientController;
use App\Http\Controllers\Api\ScoreNormController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserMainController;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::post('auth/register',[AuthController::class,'create']);
Route::post('auth/login',[AuthController::class,'login']);

/*rutas para resolver el test sin autenticación*/
// Route::group(['as'=>'api/public'],function() {
    // rutas para form
        Orion::resource('forms-only', FormCompleteController::class)->only(['search']);
        Route::post('forms-only/client-stats', [FormCompleteController::class, 'getWithUserStats']);
        // Client management routes
        Orion::resource('clients', ClientController::class)->withSoftDeletes();
        // Answer management routes (independent)
        Orion::resource('answers', AnswerController::class)->withSoftDeletes();
        Route::post('answers/send-results', [AnswerController::class, 'sendResults']);
        //escribir sus respuestas
        Orion::resource('results-tests-by-client', ResultsTestByClientController::class);
// });


Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('auth/logout',[AuthController::class,'logout']);
    // Route::group(['as'=>'api'],function() {
        Orion::resource('modules',ModuleController::class);
        Orion::hasManyResource('modules','mains',MainController::class);
        Orion::resource('categoryuser',CategoryUserController::class);
        Orion::resource('users',UserController::class);
        Route::post('users/{user}/image', [UserController::class, 'updateImage']);
        // Orion::belongsToManyResource('mains', 'categories', MainCategoryUsersController::class);
        Orion::belongsToManyResource('categoryusers', 'mains', CategoryUserMainsController::class);
        Orion::belongsToManyResource('users', 'mains', UserMainController::class);  // Commented out - relationship doesn't exist
        Route::get('users/{userid}/roles-by-module/{moduleId}', [UserMainController::class, 'getRolesByModule']);  // Commented out - relationship doesn't exist
        Route::get('category-users/{categoryId}/roles-by-module/{moduleId}', [CategoryUserController::class, 'getRolesByModule']);

        // Form management routes
        Orion::resource('category-forms', CategoryFormController::class)->withSoftDeletes();
        Orion::hasManyResource('category-forms', 'forms', FormController::class)->withSoftDeletes();
        Orion::hasManyResource('forms', 'form-sections', FormSectionController::class)->withSoftDeletes();
        Route::post('duplicate-section', [FormSectionController::class, 'duplicateSection']);
        Orion::resource('category-questions', CategoryQuestionController::class)->withSoftDeletes();
        Orion::hasManyResource('form-sections', 'questions', QuestionController::class)->withSoftDeletes();
        Route::post('duplicate-question', [QuestionController::class, 'duplicateQuestion']);
        Orion::hasManyResource('questions', 'question-options', QuestionOptionController::class)->withSoftDeletes();
        // rutas para el score de normas
        Orion::hasManyResource('category-forms','score-norms', CategoryFormScoreNormController::class)->withSoftDeletes();
        //rutas para los resultados de tests por cliente


        // rutas para form
        // Orion::resource('forms-only', FormCompleteController::class)->only(['search']);
        // Route::post('forms-only/client-stats', [FormCompleteController::class, 'getWithUserStats']);
        // // Client management routes
        // Orion::resource('clients', ClientController::class)->withSoftDeletes();
        // // Answer management routes (independent)
        // Orion::resource('answers', AnswerController::class)->withSoftDeletes();
    // });
});
