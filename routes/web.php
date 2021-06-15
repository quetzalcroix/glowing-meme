<?php

use App\Models\Settings;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
//cron url
Route::get('/cron', 'App\Http\Controllers\Controller@autotopup')->name('cron');
//Front Pages Route
// Route::get('/', 'App\Http\Controllers\UsersController@index')->name('home');
Route::redirect('/', 'dashboard')->name('home');

// Route::get('terms', 'UsersController@terms')->name('terms');
// Route::get('privacy', 'UsersController@privacy')->name('privacy');
// Route::get('about', 'UsersController@about')->name('about');
// Route::get('contact', 'UsersController@contact')->name('contact');
// Route::get('faq', 'UsersController@faq')->name('faq');
// Everything About Admin Route started here
//Route::prefix('rangda')->group(function () {
Route::group(['prefix' => 'rangda' , 'namespace' => 'App\Http\Controllers\Admin\Auth'],function () {
    Route::redirect('/', 'rangda/login');
    Route::get('login', 'LoginController@showLoginForm')->name('adminLoginForm');
    Route::post('login', 'LoginController@adminLogin')->name('adminLogin');
    Route::get('logout', 'LoginController@adminlogout')->name('adminlogout');
    Route::get('dashboard', 'LoginController@validate_admin')->name('validate_admin');
});
Route::group(['prefix' => 'rangda/v2', 'middleware' => 'isadmin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');
    Route::get('dashboard/plans', ['uses' => 'HomeController@plans'])->name('admin.manage-membership');
    Route::get('dashboard/manageusers', ['uses' => 'HomeController@manageusers'])->name('admin.manage-users');
    // CRM ROUTES
    Route::get('dashboard/calendar', ['uses' => 'HomeController@calendar'])->name('calendar');
    Route::get('dashboard/task', ['uses' => 'HomeController@showtaskpage'])->name('task');
    Route::get('dashboard/mtask', ['uses' => 'HomeController@mtask'])->name('mtask');
    Route::get('dashboard/viewtask', ['uses' => 'HomeController@viewtask'])->name('viewtask');
    Route::post('dashboard/addtask', 'CrmController@addtask')->name('addtask');
    Route::post('dashboard/updatetask', 'CrmController@updatetask')->name('updatetask');
    Route::get('dashboard/deltask/{id}', 'CrmController@deltask')->name('deltask');
    Route::get('dashboard/markdone/{id}', 'CrmController@markdone')->name('markdone');
    Route::get('dashboard/leads', ['uses' => 'HomeController@leads'])->name('leads');
    Route::get('dashboard/leadsassign', ['uses' => 'HomeController@leadsassign'])->name('leadsassign');
    Route::post('dashboard/updateuser', 'CrmController@updateuser')->name('updateuser');
    Route::get('dashboard/convert/{id}', 'CrmController@convert')->name('convert');
    Route::get('dashboard/customer', ['uses' => 'HomeController@customer'])->name('customer');
    // This route is used to Assign Users
    Route::post('dashboard/assign', 'App\Http\Controllers\CrmController@assign')->name('assignuser');
    Route::get('dashboard/user-plans/{id}', 'HomeController@userplans')->name('user.plans');
    Route::get('dashboard/user-wallet/{id}', 'HomeController@userwallet')->name('user.wallet');
    Route::post('dashboard/search', 'HomeController@search');
    Route::post('dashboard/searchdp', 'HomeController@searchDp');
    Route::post('dashboard/searchWith', 'HomeController@searchWt');
    Route::post('dashboard/searchsub', 'HomeController@searchsub');
    Route::get('dashboard/mwithdrawals', 'HomeController@mwithdrawals')->name('admin.manage-withdrawals');
    Route::get('dashboard/mdeposits', 'HomeController@mdeposits')->name('admin.manage-deposits');
    Route::get('dashboard/agents', 'HomeController@agents')->name('agents');
    Route::get('dashboard/addmanager', 'HomeController@addmanager')->name('addmanager');
    Route::get('dashboard/madmin', 'HomeController@madmin')->name('admin.manage-admins');
    Route::get('dashboard/msubtrade', 'HomeController@msubtrade')->name('subtrade');
    Route::get('dashboard/settings', 'HomeController@settings')->name('admin.settings');
    Route::get('dashboard/frontpage', 'HomeController@frontpage')->name('frontpage');
    Route::get('dashboard/adduser', 'HomeController@adduser')->name('adduser');
    Route::post('dashboard/addplan', 'LogicController@addplan')->name('addplan');
    Route::post('dashboard/updateplan', 'LogicController@updateplan')->name('updateplan');
    Route::post('dashboard/topup', 'LogicController@topup')->name('topup');
    Route::post('dashboard/sendmailsingle', 'LogicController@sendmailtooneuser');
    Route::post('dashboard/sendmail', 'UsersController@sendmail');
    Route::post('dashboard/AddHistory', 'LogicController@addHistory')->name('addhistory');
    Route::post('dashboard/edituser', 'LogicController@edituser')->name('edituser');
    Route::post('dashboard/editadmin', 'UsersController@editadmin')->name('editadmin');
    Route::get('dashboard/resetpswd/{user}', 'LogicController@resetpswd')->name('resetpswd');
    Route::get('dashboard/resetadpwd/{id}', 'UsersController@resetadpwd')->name('resetadpwd');
    Route::get('dashboard/switchuser/{id}', 'LogicController@switchuser')->name('admin.switch-user');
    Route::get('dashboard/clearacct/{id}', 'LogicController@clearacct')->name('clearacct');
    Route::get('dashboard/deldeposit/{id}', 'LogicController@deldeposit')->name('deldeposit');
    Route::get('dashboard/pdeposit/{id}', 'LogicController@pdeposit')->name('pdeposit');
    Route::get('dashboard/pwithdrawal/{id}', 'LogicController@pwithdrawal')->name('pwithdrawal');
    Route::post('dashboard/rejectwithdrawal', 'LogicController@rejectwithdrawal')->name('rejectwithdrawal');
    Route::post('dashboard/addagent', 'LogicController@addagent');
    Route::get('dashboard/viewagent/{agent}', 'HomeController@viewagent')->name('viewagent');
    Route::get('dashboard/delagent/{id}', 'LogicController@delagent')->name('delagent');
    // Settings Update Routes
    Route::post('dashboard/updatecpd', 'SettingsController@updatecpd');
    Route::post('dashboard/updatesettings', 'SettingsController@updatesettings');
    Route::post('dashboard/updatepreference', 'SettingsController@updatepreference');
    Route::post('dashboard/updatewebinfo', 'SettingsController@updatewebinfo');
    Route::post('dashboard/updatebot', 'SettingsController@updatebot');
    Route::post('dashboard/updatebotswt', 'SettingsController@updatebotswt');
    Route::post('dashboard/updateasset', 'SettingsController@updateasset');
    Route::post('dashboard/updatemarket', 'SettingsController@updatemarket');
    Route::post('dashboard/updatefee', 'SettingsController@updatefee');
    Route::post('dashboard/updatesubfee', 'SettingsController@updatesubfee');
    Route::post('dashboard/updatewdmethod', 'SettingsController@updatewdmethod');
    Route::post('dashboard/addwdmethod', 'SettingsController@addwdmethod');
    Route::get('dashboard/delsub/{id}', 'LogicController@delsub');
    Route::get('dashboard/confirmsub/{id}', 'LogicController@confirmsub');
    Route::post('dashboard/saveuser', 'LogicController@saveuser');
    Route::post('dashboard/saveadmin', 'LogicController@saveadmin');
    Route::get('dashboard/unblock/{id}', 'UsersController@unblock');
    Route::get('dashboard/ublock/{id}', 'UsersController@ublock');
    Route::get('dashboard/deluser/{id}', 'UsersController@deluser')->name('deluser');
    Route::get('dashboard/adminchangepassword', 'UsersController@adminchangepassword')->name('admin-change-password');
    Route::post('dashboard/adminupdatepass', 'UsersController@adminupdatepass')->name('admin.update-pass');
    // KYC Routes
    Route::get('dashboard/kyc', 'HomeController@kyc')->name('kyc');
    Route::get('dashboard/acceptkyc/{id}', 'UsersController@acceptkyc');
    Route::get('dashboard/rejectkyc/{id}', 'UsersController@rejectkyc');
    Route::get('dashboard/uublock/{id}', 'SystemController@ublock');
    Route::get('dashboard/uunblock/{id}', 'SystemController@unblock');
    Route::get('dashboard/delsystemuser/{id}', 'LogicController@delsystemuser');
    Route::get('dashboard/usertrademode/{id}/{action}', 'SystemController@usertrademode');
    Route::post('dashboard/sendmailtoall', 'LogicController@sendmailtoall')->name('sendmailtoall');
    Route::post('dashboard/changestyle', 'UsersController@changestyle')->name('changestyle');
    Route::get('dashboard/trashplan/{id}', 'LogicController@trashplan');
    Route::get('dashboard/deletewdmethod/{id}', 'SettingsController@deletewdmethod');
    // This Route is for frontpage editing
    Route::post('dashboard/savefaq', 'LogicController@savefaq')->name('savefaq');
    Route::post('dashboard/savetestimony', 'LogicController@savetestimony')->name('savetestimony');
    Route::post('dashboard/saveimg', 'LogicController@saveimg')->name('saveimg');
    Route::post('dashboard/savecontents', 'LogicController@savecontents')->name('savecontents');
    //Update Frontend Pages
    Route::post('dashboard/updatefaq', 'LogicController@updatefaq')->name('updatefaq');
    Route::post('dashboard/updatetestimony', 'LogicController@updatetestimony')->name('updatetestimony');
    Route::post('dashboard/updatecontents', 'LogicController@updatecontents')->name('updatecontents');
    Route::post('dashboard/updateimg', 'LogicController@updateimg')->name('updateimg');
    // Delete fa and tes routes
    Route::get('dashboard/delfaq/{id}', 'LogicController@delfaq');
    Route::get('dashboard/deltestimony/{id}', 'LogicController@deltest');
    // This route is to import data from excel
    Route::post('dashboard/fileImport', 'ImportController@fileImport')->name('fileImport');
});
// Everything About Admin Route ends here

//cron url

// Route::get('dashboard/cron', 'App\Http\Controllers\Controller@autotopup')->name('cron');
Route::get('/verify-email', 'App\Http\Controllers\UsersController@verifyemail')->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect(route('dashboard'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\Controller@dashboard')->name('dashboard');
    Route::get('autoconfirm', 'CoinPaymentsAPI@autoconfirm')->name('autoconfirm');
    Route::get('/forgot-password', 'App\Http\Controllers\UsersController@forgotpassword')->name('password.request');
    Route::get('/dashboard/manage-account-security', 'App\Http\Controllers\UsersController@twofa')->name('twofa');
    // Two Factor Authentication
    Route::post('dashboard/changetheme', 'App\Http\Controllers\SomeController@changetheme')->name('changetheme');
    Route::get('2fa', 'App\Http\Controllers\TwoFactorController@showTwoFactorForm')->name('2fa');
    Route::post('2fa', 'App\Http\Controllers\TwoFactorController@verifyTwoFactor');
    Route::post('dashboard/savedocs', 'App\Http\Controllers\SomeController@savevdocs')->name('kycsubmit');
    Route::post('dashboard/paypalverify/{amount}', 'App\Http\Controllers\Controller@paypalverify')->name('paypalverify');
    Route::get('licensing', 'App\Http\Controllers\UsersController@licensing')->name('licensing');
    Route::get('dashboard/deposits', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@deposits'])->name('deposits');
    Route::get('dashboard/skip_account', ['middleware' => 'auth', 'uses' => 'Controller@skip_account']);
    Route::get('dashboard/payment', 'App\Http\Controllers\SomeController@payment')->name('payment');
    Route::get('dashboard/tradinghistory', 'App\Http\Controllers\SomeController@tradinghistory')->name('tradinghistory');
    Route::get('dashboard/accounthistory', 'App\Http\Controllers\SomeController@accounthistory')->name('accounthistory');
    Route::get('dashboard/withdrawals',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@withdrawals'])->name('user.withdrawal')->middleware('2fa');
    //dashboard
    Route::get('dashboard/paywithcard/{amount}',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@paywithcard'])->name('paywithcard');
    Route::get('dashboard/cpay/{amount}/{coin}/{ui}/{msg}', ['uses' => 'App\Http\Controllers\Controller@cpay'])->name('cpay');
    Route::get('dashboard/mplans', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@mplans'])->name('mplans');
    Route::get('dashboard/myplans',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@myplans'])->name('myplans')->middleware('2fa');
    // Route::get('dashboard/makeadmin/{id}/{action}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@makeadmin', 'as'=>'makeadmin']);
    Route::get('dashboard/pplans', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@pplan'])->name('pplans');
    //Route::get('dashboard/joinplan/{id}', ['middleware' => 'auth', 'uses' => 'Controller@joinplan']);
    Route::get('ref/{id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@ref', 'as' => 'ref']);
    Route::post('dashboard/joinplan', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@joinplan']);
    Route::post('dashboard/paywithcard/charge', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@charge']);
    Route::post('dashboard/withdrawal', 'App\Http\Controllers\SomeController@withdrawal');
    Route::post('sendcontact', 'App\Http\Controllers\UsersController@sendcontact')->name('enquiry');
    Route::post('dashboard/deposit', 'App\Http\Controllers\SomeController@deposit')->name('newdeposit');
    Route::post('dashboard/chngemail', 'App\Http\Controllers\UsersController@chngemail');
    Route::post('dashboard/savedeposit', 'App\Http\Controllers\SomeController@savedeposit');
    // 	Route::post('dashboard/addwdmethod', 'SomeController@addwdmethod');
    // Paystack Route here
    Route::post('/pay', 'App\Http\Controllers\PaystackController@redirectToGateway')->name('pay.paystack');
    Route::get('/dashboard/paystackcallback', 'App\Http\Controllers\PaystackController@handleGatewayCallback');
    // Tripe Pyament
    Route::post('/dashboard/stripepay/{{amount}}', 'App\Http\Controllers\StripeController@redirectToGateway')->name('pay.stripe');
    Route::get('dashboard/accountdetails',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@accountdetails', 'as' => 'user.withdrawal-info']);
    Route::get('dashboard/changepassword',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@changepassword', 'as' => 'changepassword']);
    Route::get('dashboard/support', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@support', 'as' => 'support']);
    Route::get('dashboard/withdrawal', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@withdrawal', 'as' => 'withdrawal']);
    Route::get('dashboard/phusers', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@phusers', 'as' => 'phusers']);
    Route::get('dashboard/matchinglist',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@matchinglist', 'as' => 'matchinglist']);
    Route::get('dashboard/ghuser', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@ghuser', 'as' => 'ghuser']);
    Route::get('dashboard/confirmation/{id}',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@confirmation', 'as' => 'confirmation']);
    Route::get('dashboard/tupload/{id}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@tupload', 'as' => 'tupload']);
    Route::get('dashboard/dnpagent', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@dnpagent', 'as' => 'dnpagent']);
    Route::get('dashboard/referuser', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@referuser', 'as' => 'referuser']);
    //Route::get('dashboard/notification', 'UsersController@notification');
    Route::get('dashboard/notification',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@notification', 'as' => 'notification']);
    Route::get('dashboard/subtrade', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@subtrade'])->name('subtrade');
    Route::get('dashboard/subpricechange', 'App\Http\Controllers\Controller@subpricechange')->middleware("admin");
    Route::post('dashboard/savemt4details',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@savemt4details', 'as' => 'savemt4details']);
    Route::get('dashboard/profile', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@profile', 'as' => 'profile']);
    // Upadting user profile info
    Route::post('dashboard/profileinfo',
      ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\SomeController@updateprofile', 'as' => 'userprofile']);
    //Route::get('dashboard/plans', ['middleware' => 'auth', 'uses'=>'Controller@showplans', 'as'=>'plans']);

    Route::get('dashboard/delnotif/{id}', 'App\Http\Controllers\SomeController@delnotif');
    Route::get('dashboard/delmarket/{id}', 'App\Http\Controllers\SomeController@delmarket');
    Route::get('dashboard/delassets/{id}', 'App\Http\Controllers\SomeController@delassets');
    Route::post('dashboard/updatemark', 'App\Http\Controllers\SomeController@updatemark');
    Route::post('dashboard/updateasst', 'App\Http\Controllers\SomeController@updateasst');
    Route::post('dashboard/upload', 'App\Http\Controllers\UsersController@upload');
    Route::post('dashboard/confirm', 'App\Http\Controllers\UsersController@confirm');
    Route::get('dashboard/mconfirm/{id}/{ph_id}/{amount}', 'App\Http\Controllers\UsersController@mconfirm');
    Route::get('dashboard/mdelete/{id}/{ph_id}/{amount}', 'App\Http\Controllers\UsersController@mdelete');
    Route::post('dashboard/withdraw', 'App\Http\Controllers\SomeController@withdraw');
    Route::post('dashboard/updateacct', 'App\Http\Controllers\UsersController@updateacct')->name('updateacount');
    Route::post('dashboard/updatepass', 'App\Http\Controllers\UsersController@updatepass')->name('updatepass');
    Route::post('dashboard/dnate', 'App\Http\Controllers\UsersController@dnate');
    Route::get('dashboard/donation', ['uses' => 'App\Http\Controllers\UsersController@donation', 'as' => 'donation']);
    Route::get('dashboard/donate/{plan}', ['uses' => 'App\Http\Controllers\UsersController@donate', 'as' => 'donate']);
    Route::post('reguser', 'App\Http\Controllers\Auth\AuthController@reguser');
    Route::post('dashboard/saveagent', 'App\Http\Controllers\UsersController@saveagent');
    Route::get('dashboard/delsubtrade/{id}', 'App\Http\Controllers\Controller@delsubtrade');
    Route::get('/dashboard/submit-stripe-payment', 'App\Http\Controllers\StripeController@submitpayment');
    Route::get('/dashboard/verify-account', 'App\Http\Controllers\UsersController@verifyaccount')->name('account.verify');
});

Route::get('ref/{id}', 'App\Http\Controllers\Controller@ref');
Route::get('/dashboard/weekend', 'App\Http\Controllers\Controller@checkdate');

//activate and deactivate Online Trader
/*
Route::any('/activate', function () {
    return view('activate.index', [
      'settings' => Settings::where('id', '1')->first(),
    ]);
});
Route::any('/revoke', function () {
    return view('revoke.index');
});
*/
