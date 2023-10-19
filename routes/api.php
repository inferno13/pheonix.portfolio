<?php

use App\Http\Controllers\API\V1\DepositMethodController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('network/level', 'NetworkController@getMaxLevel');
    Route::get('balance', 'ProfileController@balance');
    Route::get('product/buy/{id}', 'ProductController@buy');
    Route::get('me', 'ProfileController@me');
    Route::get('switch-user/switch/{id}', 'SwitchUserController@switch')->middleware('can:isSuperAdmin');
    Route::get('switch-user/logout', 'SwitchUserController@logout');

    Route::apiResource('profile', 'ProfileController', ['only' => ['show', 'update']]);
    Route::apiResource('country', 'CountryController', ['only' => ['index']]);
    Route::apiResource('code', 'CodeController', ['only' => ['index']]);
    Route::apiResource('question_category', 'QuestionCategoryController', ['only' => ['index', 'show']]);
    Route::apiResource('activity', 'ActivityController', ['only' => ['index']]);
    Route::apiResource('lesson', 'LessonController', ['only' => ['update']]);
    Route::apiResource('marketing', 'MarketingController', ['only' => ['index']]);
    Route::apiResource('marketing_transaction', 'MarketingTransactionController', ['only' => ['index']])->middleware('auth:sanctum');;
    Route::apiResource('education', 'EducationController', ['only' => ['index', 'show']]);
    Route::apiResource('notification', 'NotificationController', ['only' => ['index', 'update']]);
    Route::apiResource('address', 'AddressController', ['only' => ['show']]);
    Route::apiResource('chat', 'ChatController', ['only' => ['index', 'store']]);
    Route::apiResource('partner', 'PartnerController', ['only' => ['index']]);
    Route::apiResource('ticket_category', 'TicketCategoryController', ['only' => ['index']]);
    Route::apiResource('ticket', 'TicketController', ['only' => ['index', 'show', 'store', 'update']]);
    Route::apiResource('subscription', 'SubscriptionController', ['only' => ['index', 'show']]);
    Route::apiResource('product', 'ProductController', ['only' => ['index', 'show']]);
    Route::apiResource('network', 'NetworkController', ['only' => ['index', 'show']]);
    Route::apiResource('deposit', 'DepositTransactionController', ['only' => ['index', 'show', 'store']]);
    Route::apiResource('history', 'WalletLedgerController', ['only' => ['index']]);
    Route::apiResource('deposit_method', 'DepositMethodController', ['only' => ['index', 'show']]);
    Route::apiResource('transfer', 'TransferTransactionController', ['only' => ['index', 'store']]);
    Route::apiResource('withdraw', 'WithdrawTransactionController', ['only' => ['index', 'store']]);

        Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
        Route::apiResource('all_transactions', App\Http\Controllers\API\V1\Admin\AllTransactionController::class, ['only' => 'index']);
        Route::apiResource('user', App\Http\Controllers\API\V1\Admin\UserController::class);
        Route::apiResource('campaign', App\Http\Controllers\API\V1\Admin\CampaignController::class, ['only' => ['index', 'store']]);
        Route::apiResource('ticket', App\Http\Controllers\API\V1\Admin\TicketController::class, ['only' => ['index']]);
        Route::apiResource('overview', App\Http\Controllers\API\V1\Admin\OverviewController::class, ['only' => ['index']]);
        Route::apiResource('deposit', App\Http\Controllers\API\V1\Admin\DepositTransactionController::class, ['only' => ['index']]);
        Route::apiResource('withdraw', App\Http\Controllers\API\V1\Admin\WithdrawTransactionController::class, ['only' => ['index', 'store']]);
        Route::apiResource('category', App\Http\Controllers\API\V1\Admin\CategoryController::class, ['only' => ['index', 'store']])->middleware('can:isSuperAdmin');
        Route::apiResource('product', App\Http\Controllers\API\V1\Admin\ProductController::class, ['only' => ['index']])->middleware('can:isSuperAdmin');
        Route::apiResource('subscriptions', App\Http\Controllers\API\V1\Admin\SubscriptionTransactionController::class, ['only' => ['index']])->middleware('can:isSuperAdmin');
        Route::apiResource('bonus', App\Http\Controllers\API\V1\Admin\MonthlyBonusController::class, ['only' => ['index', 'update']]);
    });
})->middleware('auth:sanctum');
