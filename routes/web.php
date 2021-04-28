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

// Route::get('/', function () {
//     return view('layout/app');
// });


Route::get('/login', function () {
	    return view('auth.login');
	})->name('login');

Route::get('googlelogin', 'Auth\LoginController@redirectToProvider');
Route::get('callback/google', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Any route within this group will redirect to the login page if called while logged out
// For testing or to allow a route to be public, just move it out of this group.
Route::group(['middleware' => 'auth'], function () {
  // Route::get('/', function () {
  //     return view('layout/app');
  // });
	Route::get('/testSelect', function(){return view('modals.sample.testSelect');});
	Route::get('/downloadSamplePartner', 'BusinessController@downloadsamplepartner')->name('samplepartner');
	Route::post('/addPartners', 'BusinessController@uploadpartners')->name('uploadpartners');


	Route::get('/', 'BusinessController@index')->name('business');
	Route::get('/business/{cluster?}/{pathway?}/{activity?}', 'BusinessController@index')->name('business');
	Route::get('/businessaddress/{cluster?}/{pathway?}/{activity?}', 'BusinessController@address')->name('businessaddress');
	Route::get('/removedpartners/{cluster?}/{pathway?}/{activity?}', 'BusinessController@removed')->name('removedpartners');
	Route::get('/businessdestroy/{id}', 'BusinessController@destroy')->name('businessdestroy');
	Route::post('/businessrestore', 'BusinessController@restore')->name('businessrestore');
	Route::post('/businessstore', 'BusinessController@store')->name('businessstore');
	Route::get('/businesssearch', 'BusinessController@search')->name('businesssearch');
	Route::post('/businessupdate', 'BusinessController@update')->name('businessupdate');
	Route::post('/businesspathwayupdate', 'BusinessController@pathwayupdate')->name('businesspathwayupdate');
	Route::post('/internshipupdate', 'BusinessController@internshipupdate')->name('internshipupdate');
	Route::get('/internshipdestroy/{id}', 'BusinessController@internshipdestroy')->name('internshipdestroy');
	Route::post('/businessinvolvementupdate', 'BusinessController@involvementupdate')->name('businessinvolvementupdate');
	Route::get('/businessdetail/{id}', 'BusinessController@businessdetail')->name('businessdetail');
	Route::get('/involvement', 'BusinessController@involvement')->name('involvement');


	Route::post('/pocstore', 'POCController@store')->name('POCstore');
	Route::post('/pocupdate', 'POCController@update')->name('POCupdate');
	Route::post('/pocdestroy', 'POCController@destroy')->name('POCdestroy');
	Route::post('/internshipadd', 'BusinessController@internshipadd')->name('internshipadd');
	Route::post('/clusterstore', 'ClusterController@store')->name('createcluster');
	Route::post('/pathwaystore', 'PathwayController@store')->name('createpathway');
	Route::post('/uploadPathways', 'PathwayController@bulkupload')->name('uploadpathways');
	Route::get('/sampleuploadpathwaysfile', 'PathwayController@sampleuploadfile')->name('samplePathwayFile');


	Route::get('/students/{semester?}/{location?}/{pathway?}', 'StudentController@index')->name('students');
	Route::get('/studentdetail/{id}', 'StudentController@studentdetail')->name('studentdetail');
	Route::post('/studentadd', 'StudentController@create')->name('studentsadd');
	Route::post('/studentupdate', 'StudentController@update')->name('studentsupdate');
	Route::post('/studentinternshipadd', 'StudentController@addinternship')->name('addinternship');
	Route::GET('/removestudent/{id?}', 'StudentController@destroy')->name('removestudent');
	Route::post('/removeInternship/{id?}', 'StudentController@removeinternship')->name('removeinternship');

	Route::get('/studentimport', 'StudentImportController@getImport')->name('studentimport');
	Route::post('/importparse', 'StudentImportController@parseImport')->name('import_parse');
	Route::post('/processImport', 'StudentImportController@processImport')->name('import_process');


	Route::get('/utils', 'ClusterController@utils');

	Route::get('/dashboard',function () {
      return view('samples.dashboardTemplate');
  });



});
//>>>>>>> 32ac7a297ffbaec943f3770b86c402e974f07ab1
