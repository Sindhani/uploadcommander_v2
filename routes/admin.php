<?php

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {

    Route::get('user', 'UserController@index')->name('user');
    Route::resource('user','UserController');
    Route::get('user/destroy/{id}', 'UserController@destroy');

    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });

    Route::resource('role','RoleController');
    Route::get('role', 'RoleController@index')->name('role');
    Route::get('role/destroy/{id}', 'RoleController@destroy');


    Route::resource('customer','CustomerController');
    Route::get('customer', 'CustomerController@index')->name('customer');
    Route::get('customer/destroy/{id}', 'CustomerController@destroy');

    Route::resource('package','PackageController');
    Route::get('package', 'PackageController@index')->name('package');
    Route::get('package/destroy/{id}', 'PackageController@destroy');

    Route::resource('productaddon','ProductAddonController');
    Route::get('productaddon', 'ProductAddonController@index')->name('productaddon');
    Route::get('productaddon/destroy/{id}', 'ProductAddonController@destroy');

    Route::resource('productfeature','ProductFeatureController');
    Route::get('productfeature', 'ProductFeatureController@index')->name('productfeature');
    Route::get('productfeature/destroy/{id}', 'ProductFeatureController@destroy');
    Route::get('productfeature/activedeactive/{id}/{status}', 'ProductFeatureController@activedeactive');

    Route::resource('settings','SettingsController');
    Route::resource('system_settings','SystemSettingController');
    Route::resource('email_settings','EmailSettingsController');

    Route::resource('coupon','CouponController');
    Route::get('coupon', 'CouponController@index')->name('coupon');
    Route::get('coupon/destroy/{id}', 'CouponController@destroy');
    Route::get('downloadData', 'CouponController@downloadData');

    Route::resource('email_template','EmailTemplateController');
    Route::get('email_template', 'EmailTemplateController@index')->name('email_template');
    Route::get('email_template/destroy/{id}', 'EmailTemplateController@destroy');
    Route::get('email_template/activedeactive/{id}/{status}', 'EmailTemplateController@activedeactive');

    Route::resource('document_template','DocumentTemplateController');
    Route::get('document_template', 'DocumentTemplateController@index')->name('document_template');
    Route::get('document_template/destroy/{id}', 'DocumentTemplateController@destroy');
    Route::get('document_template/activedeactive/{id}/{status}', 'DocumentTemplateController@activedeactive');

    Route::resource('customer_affiliate','CustomerAffiliateController');
    Route::get('affiliate_registration_cashout', 'CustomerAffiliateController@affiliateRegistrationCashout')->name('affiliate_registration_cashout');

    Route::resource('api_setting','ApiSettingController');

    Route::resource('language','LanguageController');
    Route::get('language', 'LanguageController@index')->name('language');
    Route::get('language/destroy/{id}', 'LanguageController@destroy');
    Route::get('language/activedeactive/{id}/{status}', 'LanguageController@activedeactive');

    Route::resource('variable','VariableController');




    // ticket system
    Route::get('tickets', 'TicketsController@index')->name('tickets');
    Route::get('tickets_archive', 'TicketsController@ticketsArchive')->name('tickets_archive');
    Route::get('tickets_detail', 'TicketsController@ticketDetail')->name('ticket_detail');
    Route::post('change_ticket_status', 'TicketsController@changeTicketSstatus')->name('change_ticket_status');
    Route::post('update_ticket_status', 'TicketsController@updateTicketSstatus')->name('update_ticket_status');

    Route::post('add_ticket_replies', 'TicketsController@addTicketReplies')->name('add_ticket_replies');
    Route::post('change_supporter', 'TicketsController@changeSupporter')->name('change_supporter');
    //HELPDESK
    Route::resource('helpdesk', 'HelpDeskController');
    //FAQ
    Route::resource('faq', 'FAQController');
    //MAKE ACTIVE OR INACTIVE FAQ'S
    Route::post('make_active', 'FAQController@makeActive')->name('MakeActive');
    Route::post('make_inactive', 'FAQController@makeInActive')->name('MakeInActive');
    //MAKE HELPDEKS ACTIVE OR INACVTIVE
    Route::post('hp_make_active', 'HelpDeskController@makeActive')->name('hpMakeActive');
    Route::post('hp_make_inactive', 'HelpDeskController@makeInActive')->name('hpMakeInActive');

    
});
