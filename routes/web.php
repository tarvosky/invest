<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
    //https://hdtuto.com/article/laravel-8-resize-image-laravel-8-image-intervention-example
    //https://www.codermen.com/blog/67/how-to-write-text-on-image-in-laravel-and-save
    //https://stackoverflow.com/questions/25776534/mac-os-x-10-10-php-5-5-14-free-type-support
    //https://docs.scandit.com/parser/dlid.html
    //https://github.com/milon/barcode
*/


Route::get('/test', function () {
    return view('test.test');
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);
Route::get('reload-captcha', [App\Http\Controllers\Auth\RegisterController::class, 'reloadCaptcha']);



Route::get('/download/whitepaper', function () {
    $filePath = public_path('whitepaper.pdf');
    return response()->download($filePath, 'WhitePaper.pdf');
})->name('home.white.paper');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'landing'])->name('landing');

/**
 *  PAYMENT
 */
Route::prefix('payment')->group(function () {
    Route::get('ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');
    Route::get('recharge', [PaymentController::class, 'index'])->name('payment.form');
    Route::get('withdrawal', [PaymentController::class, 'withdraw'])->name('payment.withdraw');
    Route::post('withdrawal', [PaymentController::class, 'withdrawPost'])->name('payment.withdraw.post');
    Route::get('customize/{slug}', [PaymentController::class, 'customize'])->name('payment.customize');
    Route::post('customize-post', [PaymentController::class, 'customizePost'])->name('payment.post.customize');
    Route::get('redeem', [PaymentController::class, 'redeem'])->name('redeem.form');
    Route::post('redeem-post', [PaymentController::class, 'redeemPost'])->name('redeem.post.form');
    Route::post('recharge', [PaymentController::class, 'postPayment'])->name('payment.post');
    Route::get('form-summary/{item_name}/{currency}/{amount}/{code}', [PaymentController::class, 'formSummary'])->name('form.summary');
    Route::get('address/{code}', [PaymentController::class, 'Address'])->name('form.address');
    Route::post('add-to-wallet-from-ref', [PaymentController::class, 'addToWalletFromRef'])->name('addToWalletFromRef.post');

});


Route::prefix('ajax')->group(function () {
    Route::get('/get-balance/{user}', [App\Http\Controllers\PaymentController::class, 'balance'])->name('balance');
});


Route::prefix('home')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/testimony', [App\Http\Controllers\HomeController::class, 'testimony'])->name('testimony');
    Route::get('profile', [App\Http\Controllers\HomeController::class,'profile'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\HomeController::class, 'storeProfile'])->name('profile.store');
    Route::get('how-it-works', [App\Http\Controllers\HomeController::class,'howItWorks'])->name('howitworks');
    Route::get('coming-soon', [App\Http\Controllers\HomeController::class,'comingSoon'])->name('comingsoon');
    Route::get('support', [App\Http\Controllers\HomeController::class,'support'])->name('home.support');
    Route::get('history', [App\Http\Controllers\HomeController::class,'history'])->name('home.history');
    Route::post('support', [App\Http\Controllers\HomeController::class,'postSupport'])->name('home.post.support');
    Route::get('reload-captcha', [App\Http\Controllers\HomeController::class, 'reloadCaptcha']);
    Route::get('packages', [App\Http\Controllers\HomeController::class, 'packages'])->name('home.packages');
});



Route::prefix('admin')->group(function () {
    Route::get('users', [App\Http\Controllers\AdminController::class,'users'])->name('admin.users');
    Route::get('edited-picture', [App\Http\Controllers\AdminController::class, 'editedPicture'])->name('admin.edited.picture');
    Route::post('edited-picture', [App\Http\Controllers\AdminController::class, 'postPicture'])->name('admin.post.picture');
    Route::get('credit-user', [App\Http\Controllers\AdminController::class, 'creditUserForm'])->name('admin.credit.user.form');
    Route::post('credit-user', [App\Http\Controllers\AdminController::class, 'creditUser'])->name('admin.credit.user');
    Route::get('history', [App\Http\Controllers\AdminController::class,'history'])->name('admin.history');
    Route::get('invoice', [App\Http\Controllers\AdminController::class,'invoice'])->name('admin.invoice');
    Route::get('announcement/{announcement}', [App\Http\Controllers\AdminController::class,'edit'])->name('admin.announcement');
    Route::put('announcement/{announcement}/update', [App\Http\Controllers\AdminController::class,'update'])->name('announcement.update');
    Route::get('redemption', [App\Http\Controllers\AdminController::class,'redemption'])->name('admin.redemption');
    Route::get('redemption/{redemption}/edit', [App\Http\Controllers\AdminController::class,'redemptionEdit'])->name('admin.redemption.edit');
    Route::put('redemption/{redemption}/update', [App\Http\Controllers\AdminController::class, 'redemptionUpdate'])->name('admin.redemption.update');

});





/**
 * DIVORCE CERTIFICATE
 */


Route::resource('divorce-certificate', App\Http\Controllers\DivorceController::class);
Route::prefix('divorce-certificate')->group(function () {
Route::get('{divorce-certificate}/delete', [App\Http\Controllers\DivorceController::class, 'delete'])->name('divorce-certificate.delete');
Route::post('create-document', [App\Http\Controllers\DivorceController::class, 'createDocument'])->name('divorce-certificate.create.document');
});


/**
 * LAWYER LICENSE
 */



Route::resource('lawyers-license', App\Http\Controllers\LawyerLicenseController::class);
Route::prefix('lawyers-license')->group(function () {
Route::get('{lawyers_license}/delete', [App\Http\Controllers\LawyerLicenseController::class, 'delete'])->name('lawyers-license.delete');
Route::post('create-document', [App\Http\Controllers\LawyerLicenseController::class, 'createDocument'])->name('lawyers-license.create.document');
});






/**
 * WILL
 */


Route::resource('wills', App\Http\Controllers\WillController::class);
Route::prefix('wills')->group(function () {
Route::get('{will}/delete', [App\Http\Controllers\WillController::class, 'delete'])->name('wills.delete');
Route::post('create-document', [App\Http\Controllers\WillController::class, 'createDocument'])->name('wills.create.document');
});


/**
 * EIN LETTER
 */

Route::resource('einletter', App\Http\Controllers\EinletterController::class);
Route::prefix('einletter')->group(function () {
    Route::get('{einletter}/delete', [App\Http\Controllers\EinletterController::class, 'delete'])->name('einletter.delete');
    Route::post('create-document', [App\Http\Controllers\EinletterController::class, 'createDocument'])->name('einletter.create.document');

});






/**
 * PAYSTUB
 */

Route::resource('paystubs', App\Http\Controllers\PaystubController::class);
Route::prefix('paystubs')->group(function () {
    Route::get('{paystub}/delete', [App\Http\Controllers\PaystubController::class, 'delete'])->name('paystubs.delete');
    Route::post('create-document', [App\Http\Controllers\PaystubController::class, 'createDocument'])->name('paystubs.create.document');

});






/**
 * RENTAL
 */

Route::prefix('rental')->group(function () {
    Route::get('notice-to-vacate', [App\Http\Controllers\RentalController::class, 'ntv'])->name('rental.ntv');
    Route::get('create-notice-to-vacate', [App\Http\Controllers\RentalController::class, 'createNtv'])->name('rental.create.ntv');
    Route::get('edit-notice-to-vacate/{vacate}', [App\Http\Controllers\RentalController::class, 'editNtv'])->name('rental.edit.ntv');
    Route::put('update-notice-to-vacate', [App\Http\Controllers\RentalController::class, 'updateNtv'])->name('rental.update.ntv');
    Route::post('create-notice-to-vacate', [App\Http\Controllers\RentalController::class, 'postNtv'])->name('rental.post.ntv');
    Route::post('create-document-ndv', [App\Http\Controllers\RentalController::class, 'createDocumentNdv'])->name('rental.create.ntv');
    Route::get('delete-notice-to-vacate/{vacate}', [App\Http\Controllers\RentalController::class, 'deleteNtv'])->name('rental.delete.ntv');


    Route::get('late-rent', [App\Http\Controllers\RentalController::class, 'lr'])->name('rental.lr');
    Route::get('create-late-rent', [App\Http\Controllers\RentalController::class, 'createLr'])->name('rental.create.lr');
    Route::post('create-late-rent', [App\Http\Controllers\RentalController::class, 'postLr'])->name('rental.post.lr');
    Route::get('edit-late-rent/{rent}', [App\Http\Controllers\RentalController::class, 'editLr'])->name('rental.edit.lr');
    Route::put('update-late-rent', [App\Http\Controllers\RentalController::class, 'updateLr'])->name('rental.update.lr');
    Route::post('create-document-lr', [App\Http\Controllers\RentalController::class, 'createDocumentLr'])->name('rental.create.lr');
    Route::get('delete-late-rent/{rent}', [App\Http\Controllers\RentalController::class, 'deleteLr'])->name('rental.delete.lr');


    Route::get('lease-agreement', [App\Http\Controllers\RentalController::class, 'la'])->name('rental.la');
    Route::get('create-lease-agreement', [App\Http\Controllers\RentalController::class, 'createLa'])->name('rental.create.la');
    Route::post('create-lease-agreement', [App\Http\Controllers\RentalController::class, 'postLa'])->name('rental.post.la');
    Route::get('edit-lease-agreement/{lease}', [App\Http\Controllers\RentalController::class, 'editLa'])->name('rental.edit.la');
    Route::put('update-lease-agreement', [App\Http\Controllers\RentalController::class, 'updateLa'])->name('rental.update.la');
    Route::post('create-document-la', [App\Http\Controllers\RentalController::class, 'createDocumentLa'])->name('rental.create.la');
    Route::get('delete-lease-agreement/{lease}', [App\Http\Controllers\RentalController::class, 'deleteLa'])->name('rental.delete.la');
});









/**
 *  VOID CHECKS
 */


Route::resource('voidcheck', App\Http\Controllers\VoidcheckController::class);
Route::prefix('voidcheck')->group(function () {
    Route::get('{voidcheck}/delete', [App\Http\Controllers\VoidcheckController::class, 'delete'])->name('voidcheck.delete');
    Route::get('upload-logo/{voidcheck}', [App\Http\Controllers\VoidcheckController::class, 'uploadLogo'])->name('voidcheck.logo');
    Route::post('upload-logo', [App\Http\Controllers\VoidcheckController::class, 'postUploadLogo'])->name('voidcheck.logo.upload');
    Route::get('get-background/{voidcheck}', [App\Http\Controllers\VoidcheckController::class, 'background'])->name('background.voidcheck');
    Route::post('create-document', [App\Http\Controllers\VoidcheckController::class, 'createDocument'])->name('voidcheck.create.document');
//Ajax
Route::get('get-selected-background/{voidcheck}', [App\Http\Controllers\VoidcheckController::class, 'getSelectedBg'])->name('get.selected.bg.voidcheck');
Route::post('update-selected-background/{voidcheck}', [App\Http\Controllers\VoidcheckController::class, 'updateSelectedBg'])->name('selected.bg.voidcheck');




});



/**
 * Tax
 */
Route::resource('tax-documents', App\Http\Controllers\TaxController::class);
Route::prefix('tax-documents')->group(function () {
    Route::get('{tax_document}/delete', [App\Http\Controllers\TaxController::class, 'delete'])->name('tax-documents.delete');
    Route::post('create-document', [App\Http\Controllers\TaxController::class, 'createDocument'])->name('tax-documents.create.document');

});

Route::prefix('1099')->group(function () {
    Route::resource('contractor', App\Http\Controllers\ContractorController::class);
    Route::get('{contractor}/delete', [App\Http\Controllers\ContractorController::class,'Delete']);
    Route::post('create-document', [App\Http\Controllers\ContractorController::class, 'createDocument'])->name('contractor.create.document');
});


Route::prefix('w2')->group(function () {
    Route::resource('employee', App\Http\Controllers\EmployeeController::class);
    Route::get('{employee}/delete', [App\Http\Controllers\EmployeeController::class,'Delete']);
    Route::post('create-document', [App\Http\Controllers\EmployeeController::class, 'createDocument'])->name('employee.create.document');

});



Route::prefix('utility')->group(function () {
    Route::get('/', [App\Http\Controllers\UtilityController::class,'index'])->name('utility.index');
    Route::get('create', [App\Http\Controllers\UtilityController::class,'create'])->name('utility.create');
    Route::post('create', [App\Http\Controllers\UtilityController::class,'store'])->name('utility.store');
    Route::get('{utility}/edit', [App\Http\Controllers\UtilityController::class,'edit'])->name('utility.edit');
    Route::get('{utility}/delete', [App\Http\Controllers\UtilityController::class,'delete'])->name('utility..delete');
    Route::put('{utility}/update', [App\Http\Controllers\UtilityController::class,'update'])->name('utility.update');
    Route::post('create-document', [App\Http\Controllers\UtilityController::class,'createDocument'])->name('utility.create.document');

    Route::get('/energy', [App\Http\Controllers\UtilityController::class,'energy'])->name('utility.energy');
    Route::get('{energy}/energy-delete', [App\Http\Controllers\UtilityController::class,'energyDelete'])->name('utility.energy.delete');
    Route::get('/energy-create', [App\Http\Controllers\UtilityController::class,'energyCreate'])->name('utility.energy.create');
    Route::post('energy-create', [App\Http\Controllers\UtilityController::class,'energyStore'])->name('utility.energy.store');
    Route::get('{energy}/energy-edit', [App\Http\Controllers\UtilityController::class,'energyEdit'])->name('utility.energy.edit');
    Route::put('{energy}/energy-update', [App\Http\Controllers\UtilityController::class,'energyUpdate'])->name('utility.energy.update');
    Route::post('create-energy-document', [App\Http\Controllers\UtilityController::class,'createEnergyDocument'])->name('utility.energy.create.document');


});




/**
 * Passports
 */

Route::resource('passports', App\Http\Controllers\PassportController::class);
Route::prefix('passports')->group(function () {
Route::get('{passport}/delete', [App\Http\Controllers\PassportController::class,'passportDelete']);
Route::get('get-background/{passport}', [App\Http\Controllers\PassportController::class, 'background'])->name('background.passports');
Route::post('create-document', [App\Http\Controllers\PassportController::class, 'createDocument'])->name('create.document.social');
//Ajax
Route::get('get-selected-background/{passport}', [App\Http\Controllers\PassportController::class, 'getSelectedBg'])->name('get.selected.bg.passport');
Route::post('update-selected-background/{passport}', [App\Http\Controllers\PassportController::class, 'updateSelectedBg'])->name('selected.bg.passport');
Route::get('get-selected-photo/{passport}', [App\Http\Controllers\PassportController::class, 'getSelectedPic'])->name('get.selected.pic.passport');
Route::post('update-selected-photo/{passport}', [App\Http\Controllers\PassportController::class, 'updateSelectedPic'])->name('selected.pic.passport');

Route::get('get-photo/{passport}', [App\Http\Controllers\PassportController::class, 'photo'])->name('photo.passport');
Route::post('create-document', [App\Http\Controllers\PassportController::class, 'createDocument'])->name('create.document.passport');
Route::post('upload-photo', [App\Http\Controllers\PassportController::class, 'postUploadLogo']);
});




/**
 * SSN
 */

Route::resource('socials', App\Http\Controllers\SSNController::class);
Route::prefix('socials')->group(function () {
Route::get('{social}/delete', [App\Http\Controllers\SSNController::class,'socialDelete']);
Route::get('get-background/{social}', [App\Http\Controllers\SSNController::class, 'background'])->name('background.socials');
Route::post('create-document', [App\Http\Controllers\SSNController::class, 'createDocument'])->name('create.document.social');
//Ajax
Route::get('get-selected-background/{social}', [App\Http\Controllers\SSNController::class, 'getSelectedBg'])->name('get.selected.bg.social');
Route::post('update-selected-background/{social}', [App\Http\Controllers\SSNController::class, 'updateSelectedBg'])->name('selected.bg.social');
Route::put('redemption/{redemption}/edit', [App\Http\Controllers\AdminController::class,'redemptionEdit'])->name('admin.redemption.edit');

});




/**
 * STATEMENT
 */

Route::resource('statements', App\Http\Controllers\StatementController::class);

Route::prefix('statements')->group(function () {
    Route::get('transactions/{statement}', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/{statement}/delete', [App\Http\Controllers\TransactionController::class, 'destroyStatement'])->name('transactions.destroy.statement');
    Route::post('transactions/{statement}', [App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');
    Route::get('transactions-delete/{transaction}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('transactions/{transaction}/edit', [App\Http\Controllers\TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('transactions/{transaction}/update', [App\Http\Controllers\TransactionController::class, 'update'])->name('transactions.update');
    Route::get('download-pdf/{statement}', [App\Http\Controllers\TransactionController::class, 'downloadPdf'])->name('download.pdf');
    Route::post('download-pdf', [App\Http\Controllers\TransactionController::class, 'storePdf'])->name('store.pdf');
    // statementController
    Route::get('{statement}/delete', [App\Http\Controllers\StatementController::class, 'deleteStatement'])->name('statements.delete');
    Route::get('logo/upload-logo/{statement}', [App\Http\Controllers\StatementController::class, 'uploadLogo'])->name('statements.logo');
    Route::post('logo/upload-logo', [App\Http\Controllers\StatementController::class, 'postUploadLogo'])->name('statements.logo.upload');
});


Route::prefix('custom-statements')->group(function () {
    Route::get('/', [App\Http\Controllers\StatementController::class, 'customIndex'])->name('statement.custom.index');
    Route::get('create-custom-statement', [App\Http\Controllers\StatementController::class, 'customCreate'])->name('statement.custom.create');
    Route::post('create-custom-statement', [App\Http\Controllers\StatementController::class, 'customStore'])->name('statement.custom.store');
    Route::get('{statement}/edit-custom-statement', [App\Http\Controllers\StatementController::class, 'customEdit'])->name('statement.custom.edit');
    Route::put('{statement}/update-custom-statement', [App\Http\Controllers\StatementController::class, 'customUpdate'])->name('statement.custom.update');
    Route::get('delete-custom-statement', [App\Http\Controllers\StatementController::class, 'customDelete'])->name('statement.custom.delete');
});


/**
 * LICENSE
 */
Route::prefix('license')->group(function () {
Route::get('index', [App\Http\Controllers\LicenseController::class, 'index'])->name('license.index');
Route::get('create-license', [App\Http\Controllers\LicenseController::class, 'createLicense'])->name('create.license');
Route::get('edit-license/{license}', [App\Http\Controllers\LicenseController::class, 'editLicense'])->name('edit.license');
Route::put('update-license/{license}', [App\Http\Controllers\LicenseController::class, 'updateLicense'])->name('update.license');
Route::post('store-license', [App\Http\Controllers\LicenseController::class, 'storeLicense'])->name('store.license');
Route::get('get-document', [App\Http\Controllers\LicenseController::class, 'getDocument'])->name('get.document');

Route::get('get-photo/{license}', [App\Http\Controllers\LicenseController::class, 'photo'])->name('photo.license');
Route::get('get-background/{license}', [App\Http\Controllers\LicenseController::class, 'background'])->name('background.license');
Route::post('upload-photo', [App\Http\Controllers\LicenseController::class, 'uploadPhoto']);
Route::post('upload-bg', [App\Http\Controllers\LicenseController::class, 'uploadBg']);
Route::get('{license}/delete', [App\Http\Controllers\LicenseController::class, 'licenseDelete'])->name('license.delete');

Route::get('get-selected-photo/{license}', [App\Http\Controllers\LicenseController::class, 'getSelectedPhoto'])->name('get.selected.photo.license');
Route::post('update-selected-photo/{license}', [App\Http\Controllers\LicenseController::class, 'updateSelectedPhoto'])->name('selected.photo.license');
Route::get('get-selected-background/{license}', [App\Http\Controllers\LicenseController::class, 'getSelectedBg'])->name('get.selected.bg.license');
Route::post('update-selected-background/{license}', [App\Http\Controllers\LicenseController::class, 'updateSelectedBg'])->name('selected.bg.license');
// create Doc
Route::post('create-document', [App\Http\Controllers\LicenseController::class, 'createDocument'])->name('create.document');
});


/**
 *  SMS VERIFICATION
 */
Route::resource('sms', App\Http\Controllers\SMSController::class);
Route::prefix('verification')->group(function () {
    Route::get('get-sms', [App\Http\Controllers\SMSController::class, 'getSms'])->name('sms.getsms');
    Route::get('get-number/{service}/{country}', [App\Http\Controllers\SMSController::class, 'getNumber'])->name('sms.get.number');
   // Route::get('reuse-number/{thetime}/{number}/{service}/{country}', [App\Http\Controllers\SMSController::class, 'reuseNumber'])->name('sms.reuse.number');
});

//Ajax
Route::prefix('sms-ajax')->group(function () {
    Route::get('get-number/{service}/{country}', [App\Http\Controllers\SMSController::class, 'getNumberAjax'])->name('get.number.sms');
    Route::get('get-balance', [App\Http\Controllers\SMSController::class, 'getBalanceAjax'])->name('get.balance.sms');
    Route::post('post-sms-service', [App\Http\Controllers\SMSController::class, 'postSmsService'])->name('post.sms.service');
    Route::get('request-code/{service}/{country}/{number}', [App\Http\Controllers\SMSController::class, 'requestCodeAjax'])->name('request.code.sms');
});




//testing Route
Route::get('crop-image', [App\Http\Controllers\TestController::class, 'cropImage']);
Route::get('test/tax', [App\Http\Controllers\TestController::class, 'tax']);
Route::get('test/payment', [App\Http\Controllers\TestController::class, 'payment'])->middleware(['auth']);
Route::get('test/bonus', [App\Http\Controllers\TestController::class, 'paymentBonusOn500Above1000'])->middleware(['auth']);
Route::get('test/check-date', [App\Http\Controllers\TestController::class, 'checkDate']);
