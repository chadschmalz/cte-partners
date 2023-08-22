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
	// Route::get('/', function(){return abort(404);})->middleware(['auth', 'roles:404,systemerror,noaccess']);
	Route::group(['middleware' => 'auth'], function () {
  // Route::get('/', function () {
  //     return view('layout/app');
  // });
	
  Route::group(['middleware' => 'roles:404,error,noaccess'], function (){
	Route::get('/access', function(){ return abort(404);});
	Route::get('/noaccess', function(){ return abort(404);});
  
	});
  Route::group(['middleware' => 'roles:view,fulledit,fullaccess,superuser'], function (){

	Route::get('/testSelect', function(){return view('modals.sample.testSelect');});
	Route::get('/downloadSamplePartner', 'BusinessController@downloadsamplepartner')->name('samplepartner');
	Route::post('/addPartners', 'BusinessController@uploadpartners')->name('uploadpartners');


	Route::get('/business/{cluster?}/{pathway?}/{activity?}', 'BusinessController@index')->name('business');
	Route::get('/allpocs/{cluster?}/{pathway?}/{activity?}', 'BusinessController@allpocs')->name('allpocs');
	Route::get('/businessaddress/{cluster?}/{pathway?}/{activity?}', 'BusinessController@address')->name('businessaddress');
	Route::get('/removedpartners/{cluster?}/{pathway?}/{activity?}', 'BusinessController@removed')->name('removedpartners');
	Route::get('/businessdestroy/{id}', 'BusinessController@destroy')->name('businessdestroy');
	Route::post('/businessrestore', 'BusinessController@restore')->name('businessrestore');
	Route::post('/businessstore', 'BusinessController@store')->name('businessstore');
	Route::get('/businesssearch', 'BusinessController@search')->name('businesssearch');
	Route::post('/businessupdate', 'BusinessController@update')->name('businessupdate');
	Route::post('/businesspathwayupdate', 'BusinessController@pathwayupdate')->name('businesspathwayupdate');
	Route::post('/addbusinesspathway', 'BusinessController@addpathway')->name('businesspathwayadd');
	Route::post('/bizpathwayupdate', 'BusinessController@updatepathway')->name('bizpathwayupdate');
	Route::get('/businessActivePathway/{cluster}/{pathway}/{activity}/{semester}', 'BusinessController@businessActivePathway')->name('businessActivePathway');

	Route::post('/businessemail/{id}', 'BusinessController@businessemail')->name('businessemail');

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
	Route::get('/pathways', 'PathwayController@index')->name('pathways');
	Route::post('/updatepathways', 'PathwayController@updatepathways')->name('updatepathways');
	Route::post('/pathwaystore', 'PathwayController@store')->name('createpathway');
	Route::post('/uploadPathways', 'PathwayController@bulkupload')->name('uploadpathways');
	Route::get('/sampleuploadpathwaysfile', 'PathwayController@sampleuploadfile')->name('samplePathwayFile');


	Route::get('/', 'StudentController@index')->name('students');
	Route::get('/togglePresent', 'StudentController@togglepresentmode')->name('PresentMode');

	//student routes
	Route::get('/students/{semester?}/{location?}/{pathway?}/{cluster?}', 'StudentController@index')->name('students');
	Route::get('/studentdetail/{id}', 'StudentController@studentdetail')->name('studentdetail');
	Route::get('/onboardingComplete/{id}', 'StudentController@onboardingComplete')->name('onboardingComplete');
	Route::get('/backtounassigned/{id}', 'StudentController@backtounassigned')->name('backtounassigned');
	Route::post('/studentadd', 'StudentController@create')->name('studentsadd');
	Route::post('/studentupdate', 'StudentController@update')->name('studentsupdate');
	Route::post('/studentinternshipadd', 'StudentController@addinternship')->name('addinternship');
	Route::post('/addsemester', 'StudentController@addsemester')->name('addsemester');
	Route::post('/removesemester', 'StudentController@removesemester')->name('removesemester');
	Route::GET('/removestudent/{id?}', 'StudentController@destroy')->name('removestudent');
	Route::post('/removeInternship/{id?}', 'StudentController@removeinternship')->name('removeinternship');
	Route::get('/appemail/{id?}', 'StudentController@applicationemail')->name('appemail');
	Route::get('/appemailPreview/{id?}', 'StudentController@applicationemail')->name('appemail');
	Route::get('/updatestudentresponse', 'StudentController@updatestudentresponse')->name('updatestudentresponse');
	Route::get('/updatestudenttracking', 'StudentController@updatestudenttracking')->name('updatestudenttracking');
	Route::get('/updatetrackingAjax', 'StudentController@updatestudenttrackingAjax')->name('updatestudenttrackingAjax');
	Route::post('/updatestudentws', 'StudentController@updatestudentws')->name('updatestudentws');

	Route::get('/studentapplications/{year?}', 'StudentController@studentapplications')->name('studentapplications');
	Route::get('/studentclusters/{year?}', 'StudentController@studentclusters')->name('studentclusters');
	Route::get('/eventreport/{year?}', 'EventController@eventreport')->name('eventreport');


//event routes
	Route::get('/events/{semester?}/{location?}/{cluster?}', 'EventController@index')->name('events');
	Route::get('/eventedit/{id?}', 'EventController@edit')->name('eventedit');
	Route::get('/eventadd', 'EventController@add')->name('eventadd');
	Route::post('/eventstore', 'EventController@store')->name('eventstore');
	Route::post('/eventupdate', 'EventController@update')->name('eventupdate');





	Route::get('/acceptedPreview', function () {
		    return view('email.applicationaccepted');
		})->name('appEmailApprovedPreview');


	Route::get('/formimport', 'FormImportController@getImport')->name('formimport');
	Route::post('/importparse', 'FormImportController@parseImport')->name('import_parse');
	Route::post('/processImport', 'FormImportController@processImport')->name('import_process');
	Route::get('/studentimport', 'StudentImportController@getImport')->name('studentimport');
	Route::post('/directStudentImport', 'StudentImportController@directProcessImport')->name('directStudentImport');


	Route::get('/semesters/{semester?}/{location?}/{pathway?}', 'SemesterController@index')->name('semesters');
	Route::post('/semesteradd', 'SemesterController@store')->name('semesteradd');
	Route::post('/semesterupdate', 'SemesterController@update')->name('semesterupdate');

	Route::get('/counselors/{location?}/{pathway?}', 'CounselorController@index')->name('counselors');
	Route::post('/counseloradd', 'CounselorController@store')->name('counseloradd');
	Route::post('/counselorupdate', 'CounselorController@update')->name('counselorupdate');
	Route::get('/removecounselor/{id}', 'CounselorController@destroy')->name('removecounselor');

	Route::get('/pathwayseats/{semester}/{location?}/{pathway?}', 'PathwaySeatController@pathwayseats')->name('pathwayseats');
	Route::post('/updatepathwayseats', 'PathwaySeatController@update')->name('pathwayseatsupdate');
	Route::post('/copypathwayseats', 'PathwaySeatController@copy')->name('pathwayseatscopy');
	Route::get('/seatallocation/{semester}', 'PathwaySeatController@seatallocation')->name('seatallocation');


	Route::get('/locations/', 'LocationController@index')->name('locations');
	Route::get('/locationdestroy/{id}', 'LocationController@destroy')->name('locationdestroy');
	Route::post('/locationadd', 'LocationController@store')->name('locationadd');
	Route::post('/locationupdate', 'LocationController@update')->name('locationupdate');
	Route::get('/locationimport', 'LocationController@getImport')->name('locationimport');
	Route::post('/locationparse', 'LocationController@parseImport')->name('locationparse');
	Route::post('/processLocationImport', 'LocationController@processImport')->name('locationImport');


	Route::get('/utils', 'ClusterController@utils');

	Route::get('/dashboard',function () {
      return view('samples.dashboardTemplate');
  });

});


});
//>>>>>>> 32ac7a297ffbaec943f3770b86c402e974f07ab1
