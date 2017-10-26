<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('test', function() {
    if($_SERVER['HTTP_HOST'] == '54.209.209.56') {

    }
});

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware'=>['web','admin']],function(){

    Route::get('/admin/domains/show',[
        'as' =>'domains',
        'uses' =>'Google\RestrictedDomainsController@getAll'
    ]);

    Route::post('/admin/domains/add',[
        'as' =>'adddomain',
        'uses' =>'Google\RestrictedDomainsController@addDomain'
    ]);

    Route::post('/admin/domains/delete',[
        'as' =>'deletedomain',
        'uses' =>'Google\RestrictedDomainsController@deleteDomain'
    ]);
    Route::post('/admin/domains/update',[
        'as' =>'updatedomain',
        'uses' =>'Google\RestrictedDomainsController@updateDomain'
    ]);

    Route::any('/admin/users/show',[
        'as' =>'users',
        'uses' =>'Admin\UserManagerController@display'
    ]);

    Route::post('/admin/users/add',[

        'as' => 'addUser',
        'uses' => 'Admin\RegisterUserController@create'
    ]);

//    Route::post('/admin/users/resetpassword',[
//
//        'as' => 'resetPassword',
//        'uses' => 'Admin\ResetPasswordController@postEmail'
//    ]);

    Route::post('/admin/users/updateuser',[
        'as'=>'updateUser',
        'uses'=>'Admin\UpdateUserController@updateUser'
    ]);
});

Route::group(['middleware' => ['web','auth']], function () {

    Route::post('/admin/report/files',[

        'as'=>'files',
        'uses'=>'Reports\ReportFilesController@getReportFiles'
    ]);

    Route::post('/admin/report/files/delete',[

        'as'=>'deletefiles',
        'uses'=>'Reports\ReportFilesController@deleteFile'
    ]);

    Route::post('/admin/report/files/edit',[

        'as'=>'editfiles',
        'uses'=>'Reports\ReportFilesController@editFile'
    ]);

    Route::post('/admin/report/files/add',[

        'as'=>'addfile',
        'uses'=>'Reports\ReportFilesController@addFile'
    ]);

    Route::post('/admin/report/files/update',[

        'as'=>'updateReport',
        'uses'=>'Reports\UpdateReportController@updatereport'
    ]);

    Route::post('/admin/users/updatestatus',[

        'as'=>'updateStatus',
        'uses'=>'Reports\UpdateReportStatusController@updateReportStatus'
    ]);

    Route::get('/report/order/{id}',[

        'as'=>'order',
        'uses'=>'Reports\UpdateReportController@getUpdateReportForm'
    ]);

    Route::get('/',[
        'as'=>'home',
        'uses' => 'Reports\ReportsController@showAll'
    ]);
    Route::post('/report',[
        'uses' => 'Reports\CreateReportController@create'
    ]);

    Route::get('/report/edit/{id}',[
        'as'  => 'editReport',
        'uses' => 'Reports\ReportsController@showReport'
    ]);

    Route::post('/report/save',[
        'as' => 'saveReport',
        'uses' => 'Reports\ReportsController@saveReport'
    ]);

    Route::post('/report/publish',[
        'as' => 'publishReport',
        'uses' => 'Reports\ReportsController@publishReport'
    ]);

    Route::post('/report/uploadfrominput',[
        'as' => 'simpleupload',
         'uses' => 'Upload\UploadController@uploadFromInput'

    ]);

    Route::post('/report/uploadfromeditor',[
        'as' => 'editorupload',
        'uses' => 'Upload\UploadController@uploadFromEditorBrowser'

    ]);

    Route::post('/report/lock',[
        'as' => 'lock',
        'uses' => 'Reports\ReportsController@lockReport'
    ]);
    Route::post('/report/unlock',[
        'as' => 'unlock',
        'uses'=>'Reports\ReportsController@unlockReport'
    ]);

    Route::post('/report/uploadfromdrop',[
        'as' => 'dropupload',
        'uses' => 'Upload\UploadController@uploadFromDrop'
    ]);

    Route::get('/report/references/{report_id}',[
        'as' => 'references',
        'uses' => 'Reports\ReferencesController@show'
    ]);

    Route::get('/emptyReport',[
        'uses' => 'Reports\ReportsController@showBlank'
    ]);

    Route::get('/editor/{id}',[
        'as' => 'editor',
        'uses' => 'Editor\EditorController@display'

    ]);
    Route::get('/editor/{reportId}/google/{id}',[
        'as' => 'google',
        'uses' => 'Google\GoogleController@display'
    ]);

//    Route::post('/editor/snapshot',[
//        'as'=>'snapshot',
//        'uses'=>'SnapshotController@make'
//    ]);

    Route::post('/editor/savereferences',[
        'as'=>'savereferences',
        'uses'=>'Reports\ReferencesController@add'
    ]);

    Route::post('/editor/addbookmark',[

        'as'=>'addbookmark',
        'uses'=>'Google\BookmarksController@addBookmark'
    ]);

    Route::post('editor/removebookmark',[

        'as'=>'removebookmark',
        'uses'=>'Google\BookmarksController@removeBookmark'
    ]);

    Route::post('/googleSearch/query/remove/{id}', [
       'as'=>'removeRepostQuery',
        'uses' =>  'Google\GoogleController@removeReportQueryById'
    ]);

    Route::post('/googleSearch/query/create', [
         'as' => 'duplicateQuery',
         'uses' => 'Google\GoogleController@duplicateReportQuery'
        ]);

    Route::post('/googleSearch/query/update', [
        'as' => 'updateQuery',
        'uses' => 'Google\GoogleController@updateReportQuery'
    ]);
    Route::post('/search/preview/save',[
        'as' => 'googlePreview',
        'uses' => 'Google\ResultsController@saveResults'
    ]);

    Route::get('/search/preview/results/{reportId}/{query}',[
        'as' => 'previewResults',
        'uses' => 'Google\ResultsController@showResultsPreview'
    ]);

    Route::get('/search/preview/paginate/{reportId}/{query}',[
        'as' => 'previewResultsPaginator',
        'uses' => 'Google\ResultsController@getPaginator'
    ]);

    Route::post('/search/preview/removeResult',[
        'as' => 'removeResult',
        'uses' => 'Google\ResultsController@removeResult'
    ]);

    Route::post('/search/preview/restoreResult',[
        'as' => 'restoreResult',
        'uses' => 'Google\ResultsController@restoreResult'
    ]);

    Route::post('/search',[
        'as' => 'search',
        'uses' => 'Google\GoogleController@search'
    ]);

    Route::get('/googlePagesResults',[
        'as' => 'googlePagesResults',
        'uses' => 'Google\ResultsController@displayFirstPage'
    ]);

    Route::get('/filteredGoogleResultsByQuery/{reportId}/{query}',[
        'as' => 'filteredGoogleResults',
        'uses' => 'Google\ResultsController@getFilteredResultsForQuery'
    ]);

    Route::get('/filteredGoogleResultsByReport/{reportId}',[
        'as' => 'filteredGoogleResultsByReport',
        'uses' => 'Google\ResultsController@getFilteredResultsForReport'
    ]);

    Route::post('/filteredGoogleResults/updateResult',[
        'as' => 'filteredGoogleResults.updateResult',
        'uses' => 'Google\ResultsController@updateResult'
    ]);

    Route::post('/filteredGoogleResults/updateResultSummary',[
        'as' => 'filteredGoogleResults.updateResultSummary',
        'uses' => 'Google\ResultsController@updateSummary'
    ]);

    Route::post('/filterResults',[
        'as' => 'filterResults',
        'uses' => 'Google\ResultsController@filterResults'
    ]);


    Route::get('search/getNextPage',[
        'as' => 'search.getNextPage',
        'uses' => 'Google\ResultsController@getNextPageResults'
    ]);

    Route::post('/resultsSum',[
        'as' => 'results',
        'uses' => 'Google\GoogleController@sumResults'
    ]);

    Route::post('/clear',[
        'as' => 'clear',
        'uses' => 'Google\GoogleController@clear'
    ]);

    Route::get('/googleSearch',function(){
        return view("google_search.google_search_subsection");
    });

});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/manual',[
        'as'=>'manual',
        'uses'=>'Manual\ManualController@getManual'
    ]);
});


