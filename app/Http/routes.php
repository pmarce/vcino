<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('company', 'CompanyController');
Route::group(['prefix' => 'config'], function () {
    Route::resource('account', 'AccountController');
    Route::resource('category', 'CategoryController');
    Route::resource('supplier', 'SupplierController');
    Route::resource('typeproperty', 'TypePropertyController');
    Route::resource('quota', 'QuotaController');
    Route::resource('installation', 'InstallationController');
    Route::resource('receiptnumber', 'ReceiptNumberController');
    Route::resource('phonesite', 'PhonesiteController');
});
Route::group(['prefix' => 'properties'], function () {
    Route::resource('property', 'PropertyController');
	Route::get('/property/contact/{id?}', [
        'as' => 'properties.property.contact', 'uses' => 'PropertyController@contacts'
    ]);
	Route::resource('contact', 'ContactController');
	Route::get('/contact/list/{option?}', [
        'as' => 'properties.contact.list', 'uses' => 'ContactController@listar'
    ]);
	
});
Route::group(['prefix' => 'equipment'], function () {
    Route::resource('machinery', 'EquipmentController');
});
Route::group(['prefix' => 'communication'], function () {
    Route::get('/phonesite', [
        'as' => 'communication.phonesite.index', 'uses' => 'CommunicationController@phonesite'
    ]);
    Route::resource('communication', 'CommunicationController');
    Route::get('/send/{id}', [
        'as' => 'communication.communication.send', 'uses' => 'CommunicationController@send'
    ]);
	Route::get('/resend/{id}', [
        'as' => 'communication.communication.resend', 'uses' => 'CommunicationController@resend'
    ]);
	Route::post('/send', [
        'as' => 'communication.communication.sendcommunication', 'uses' => 'CommunicationController@sendcommunication'
    ]);
	Route::get('/register/send', [
        'as' => 'communication.register.send', 'uses' => 'CommunicationController@registersend'
    ]);
    Route::get('/copy/{id}', [
        'as' => 'communication.communication.copy', 'uses' => 'CommunicationController@copy'
    ]);
	Route::post('/copy', [
        'as' => 'communication.communication.savecopy', 'uses' => 'CommunicationController@savecopy'
    ]);
	Route::get('/print/{id}', [
        'as' => 'communication.communication.print', 'uses' => 'CommunicationController@printcom'
    ]);
});

Route::group(['prefix' => 'transaction'], function () {

	Route::get('/accountsreceivable/generate', [
        'as' => 'transaction.accountsreceivable.generate', 'uses' => 'AccountsReceivableController@generate'
    ]);
	
	Route::post('/accountsreceivable/generate', [
        'as' => 'transaction.accountsreceivable.searchgenerate', 'uses' => 'AccountsReceivableController@searchgenerate'
    ]);
	
	Route::get('/accountsreceivable/send', [
        'as' => 'transaction.accountsreceivable.send', 'uses' => 'AccountsReceivableController@send'
    ]);
	
	Route::get('/accountsreceivable/generatenotification', [
        'as' => 'transaction.accountsreceivable.generatenotification', 'uses' => 'AccountsReceivableController@generatenotification'
    ]);
	
	Route::post('/accountsreceivable/sendnotification', [
        'as' => 'transaction.accountsreceivable.sendnotification', 'uses' => 'AccountsReceivableController@sendnotification'
    ]);
	
	Route::post('/accountsreceivable/storealertpayment', [
        'as' => 'transaction.accountsreceivable.storealertpayment', 'uses' => 'AccountsReceivableController@storealertpayment'
    ]);
	Route::get('/accountsreceivable/registernotification', [
        'as' => 'transaction.accountsreceivable.registernotification', 'uses' => 'AccountsReceivableController@registernotification'
    ]);
	//Buscar en index
	
	Route::post('/accountsreceivable/storealertpayment/search', [
        'as' => 'transaction.accountsreceivable.search', 'uses' => 'AccountsReceivableController@search'
    ]);
	Route::get('/copy/{id}', [
        'as' => 'transaction.accountsreceivable.copy', 'uses' => 'AccountsReceivableController@copy'
    ]);
	
	Route::get('/accountsreceivable/print/{id}', [
        'as' => 'transaction.accountsreceivable.print', 'uses' => 'AccountsReceivableController@printing'
    ]);
	
	Route::resource('accountsreceivable', 'AccountsReceivableController');
	//cobranzas Routes
	Route::resource('collection', 'CollectionController');
	
	Route::get('collection/{id}/pdf', [
        'as' => 'transaction.collection.pdf', 'uses' => 'CollectionController@pdf'
    ]);
	
	Route::post('collection/send', [
        'as' => 'transaction.collection.send', 'uses' => 'CollectionController@sendemail'
    ]);
	Route::post('cancel', [
        'as' => 'transaction.cancel', 'uses' => 'TransactionController@anular'
    ]);
	
	//Gastos Rutas

	Route::get('expense/{expense}/copy', [
        'as' => 'transaction.expense.copy', 'uses' => 'ExpensesController@copy'
    ]);
	Route::get('expense/{id}/pdf', [
        'as' => 'transaction.expense.pdf', 'uses' => 'ExpensesController@pdf'
    ]);
	Route::resource('expense', 'ExpensesController');
	
	//Traspasos
	Route::resource('transfer', 'TransferController');
	Route::get('transfer/{id}/pdf', [
        'as' => 'transaction.transfer.pdf', 'uses' => 'TransferController@pdf'
    ]);
	Route::post('search', [
        'as' => 'transaction.search', 'uses' => 'TransactionController@search'
    ]);
	

});
Route::get('admin', [
    'as' => 'admin.home', 'uses' => 'AdminController@index'
]);

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::resource('tvservices', 'Support\TvserviceController');
	Route::resource('situacionHabitacional', 'Support\SituacionHabitacionalController');
	Route::resource('phoneservices', 'Support\PhoneServiceController');
	Route::resource('internetservices', 'Support\InternetserviceController');
	Route::resource('waterservices', 'Support\WaterserviceController');
	Route::resource('electricservices', 'Support\ElectricserviceController');
	Route::resource('typecontacts', 'Support\TypecontactController');
	Route::resource('relationcontacts', 'Support\RelationcontactController');
	Route::resource('media', 'Support\MediaController');
});

//AJAX
Route::post('contact/{property_id}/property', 'ContactController@contactbyproperty');
Route::post('accountsreceivable/{property_id}/property', 'AccountsReceivableController@accountsreceivablebyproperty');

Route::post('expenses/{supplier_id}/supplier', 'ExpensesController@expensesbysupplier');