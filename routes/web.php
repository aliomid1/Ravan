<?php

use Illuminate\Support\Facades\Route;



/*========== WEB ROUTES ==========*/

Route::get('Logout', 'Controller@Logout')->name('Logout');
Route::post('CKEDITOR', 'Controller@CKEDITOR')->name('CKEDITOR');
Route::get('/Chat', function () {
    return view('users.messages.Chat');
});
Route::post('/SendMessageSupport', 'Support\SupportController@sendmessage')->name('SendMessageSupport');


Route::post('/SubmitPaymentType', 'Web\Payment\PaymentController@SubmitPaymentType')->name('SubmitPaymentType');

Route::get('/ChatPayment/{tranid}/{typepayment}', 'Web\Payment\PaymentController@Payment')->name('ChatPayment');
Route::any('/ResponseIdpay', 'Web\Payment\PaymentController@ResponseIdpay')->name('BankResponse2');
Route::any('/BankResponse', 'Web\Payment\PaymentController@Response')->name('BankResponse');
Route::any('/BankResponse2Res', 'Web\Main\ReservationController@ResponseIdpay')->name('BankResponse2Res');
Route::any('/BankResponseRes', 'Web\Main\ReservationController@@Response')->name('BankResponseRes');
Route::any('/VrifyPlanBuy', 'Advisors\Plans\PlanController@VrifyPlanBuy')->name('VrifyPlanBuy');
Route::any('VrifyAddWallet', 'Users\Transections\TransectionsController@VrifyAddWallet')->name('VrifyAddWallet');

Route::namespace('Web')->name('Web.')->group(function () {

    // Home
    Route::get('/', 'Main\MainController@index')->name('index');
    Route::get('/page/{slug}', 'Main\MainController@Pages')->name('Page');

    // Blogs
    Route::get('/Blogs/{title?}', 'Main\MainController@Blogs')->name('Blogs');
    Route::get('/Blogs/Category/{slog}', 'Main\MainController@CategoryBlogs')->name('Category.Blogs');
    Route::get('/Blog/{slog}', 'Main\MainController@Blog')->name('Blog');
    Route::post('/Blog/{slog}', 'Main\MainController@AddBlogComment')->name('AddBlogComment');
    Route::post('/Blog', 'Main\MainController@BlogSearch')->name('BlogSearch');

    // Category
    Route::get('/Category', 'Main\MainController@Category')->name('Category');
    Route::get('/CategoryList/{id}', 'Main\MainController@CategoryList')->name('CategoryList');
    Route::get('/CategoryList/{CatId}/SubjectOfCategory/{id}', 'Main\MainController@SubjectOfCategory')->name('SubjectOfCategory');
    Route::post('/SubjectOfCategory/{id}', 'Main\MainController@AddSubjectOfCategoryComment')->name('AddSubjectOfCategoryComment');


    //Consultant
    Route::get('/ConsultantList', 'Main\MainController@ConsultantList')->name('ConsultantList');
    Route::get('/ProfileMoshaver/{id}', 'Main\MainController@ProfileMoshaver')->name('ProfileMoshaver');
    Route::post('/ConsultantListSearch', 'Main\MainController@ConsultantListSearch')->name('ConsultantListSearch');


    //About Us
    Route::get('Info', 'Main\MainController@Info')->name('Info');

    ///Contact Us
    Route::get('ContactUs', 'Main\MainController@ContactUs')->name('ContactUs');

    //Assist
    Route::get('Assist', 'Main\MainController@Assist')->name('Assist');

    //Advisor Request
    Route::get('Assist', 'Main\MainController@AdvisorRequest')->name('AdvisorRequest');
    Route::post('Assist', 'Main\MainController@AdvisorRequestPost')->name('AdvisorRequestPost');

    // Login Area
    Route::namespace('Auth')->name('auth.')->group(function () {
        Route::get('Login/{advisor?}', 'LoginController@Login')->name('Login');
        Route::post('LoginPassword', 'LoginController@LoginPassword')->name('Login.post');
        Route::post('CheckUser', 'LoginController@CheckUser')->name('CheckUser');
        Route::post('CheckCode', 'LoginController@CheckCode')->name('CheckCode');
    });

    // Anonymous
    Route::get('Anonymous', 'Main\MainController@Anonymous')->name('Anonymous');
    Route::post('Anonymouspost', 'Auth\LoginController@Anonymous')->name('Anonymous.store');

    // Checkout
    Route::get('Checkout/{id}/{type}/{date?}/{key?}', 'Main\MainController@Checkout')->name('Checkout');

    //Reserve

    Route::get('Reservation/{id}/{typepay}/{subject}/{date}/{type}/{payment}', 'Main\ReservationController@Reservation')->name('Reservation');


    //Chat
    Route::get('CreateChat/{id}/{typepay}/{payment}/{subject}', 'Chat\ChatController@CreateChat')->name('CreateChat');
    Route::get('StartChat/{id}', 'Chat\ChatController@StartChat')->name('STARTChat');
    Route::get('CheckChatData/{id}/{sender}', 'Chat\ChatController@CheckChatData')->name('CheckChatData');
    Route::get('CheckPaymentChat/{id}/{typepay}', 'Chat\ChatController@CheckPaymentChat')->name('CheckPaymentChat');
    Route::get('CheckEndChat/{id}/{time}/{type}', 'Chat\ChatController@CheckEndChat')->name('CheckEndChat');

});



/*========== Admin ROUTES ==========*/
// Just Views Returns In MainController
Route::namespace('Admins')->prefix('Admins')->name('Admins.')->group(function () {
    // Auth Admin
    Route::get('Login', 'Auth\AuthController@index')->name('Login');
    Route::post('Login/post', 'Auth\AuthController@CheckUser')->name('Login.post');


    Route::group(['middleware' => 'MustBeAdmin'], function () {
        // Dashboard
        Route::get('Dashboard', 'Main\MainController@Dashboard')->name('Dashboard');


        // Users
        Route::get('UsersList', 'Main\MainController@UsersList')->name('UsersList');
        Route::resource('User', 'Users\UserController');


        // SubjectCategory
        Route::get('SubjectCategory', 'Main\MainController@SubjectCategory')->name('SubjectCategory');
        Route::resource('SubjectCategories', 'Main\CategoryController');


        // Advisors
        Route::get('AdvisorsList', 'Main\MainController@AdvisorsList')->name('AdvisorsList');
        Route::get('AddAdvisor', 'Main\MainController@AddAdvisor')->name('AddAdvisor');
        Route::resource('Advisors', 'Advisors\AdvisorsController');
        // Advisors Request
        Route::get('AdvisorsRequestList', 'Main\MainController@AdvisorsRequestList')->name('AdvisorsRequestList');
        Route::get('AdvisorRequest/{id}', 'Main\MainController@AdvisorRequest')->name('AdvisorRequest');
        Route::delete('AdvisorRequestDelete/{id}', 'Main\MainController@AdvisorRequestDelete')->name('AdvisorRequestDelete');


        // Subjects
        Route::get('Subjects', 'Main\MainController@Subjects')->name('Subjects');
        Route::resource('Subject', 'Main\SubjectController');


        // Subjects Comments
        Route::delete('SubjectComment', 'Main\SubjectCommentsController@destroy')->name('SubjectComments.delete');
        Route::post('SubjectComment', 'Main\SubjectCommentsController@publication')->name('SubjectComments.publication');


        // Blogs
        Route::resource('Blogs', 'Main\BlogsController');
        Route::get('BlogsCategory', 'Main\MainController@BlogsCategory')->name('BlogsCategory');
        Route::resource('BlogsCategories', 'Main\BlogsCategoryController');


        // Blog Comments
        Route::delete('BlogsComment', 'Main\BlogsCommentsController@destroy')->name('BlogsComments.delete');
        Route::post('BlogsComment', 'Main\BlogsCommentsController@publication')->name('BlogsComments.publication');


        // Financial pages
        Route::get('DepositToAdvisorsAccount', 'Main\DepositToAdvisorsAccountController@index')->name('DepositToAdvisorsAccount');
        Route::post('DepositToAdvisorsAccount', 'Main\DepositToAdvisorsAccountController@status')->name('DepositToAdvisorsAccount.status');

        //UnfinishedConsultations
        Route::get('UnfinishedConsultations', 'Main\UnfinishedConsultationsController@index')->name('UnfinishedConsultations');


        // Support
        Route::get('Support', 'Main\MainController@Support')->name('Support');
        Route::get('/SupportShow/{id}', 'Support\SupportController@Show')->name('SupportShow');
        Route::get('/SupportDelete/{id}', 'Support\SupportController@destroy')->name('SupportDelete');
        Route::post('/SupportReplay', 'Support\SupportController@Replay')->name('SupportReplay');
        Route::post('/SupportMessageDelete', 'Support\SupportController@DeleteMessage')->name('SupportMessageDelete');


        //AdvicedHistory
        Route::get('AvicedHistory', 'Main\MainController@AdvicedHistory')->name('AdvicedHistory');


        // Questions
        Route::post('/AddQuestionHow', 'Main\QuestionController@AddHow')->name('AddQuestionHow');
        Route::get('/DeleteQuestionHow/{id}', 'Main\QuestionController@destroyHow')->name('DeleteQuestionHow');
        Route::post('/AddQuestionWhy', 'Main\QuestionController@AddWhy')->name('AddQuestionWhy');
        Route::get('/DeleteQuestionWhy/{id}', 'Main\QuestionController@destroyWhy')->name('DeleteQuestionWhy');
        Route::post('/AddImageWhy', 'Main\QuestionController@AddImageWhy')->name('AddImageWhy');
        Route::get('/DeleteImageWhy/{id}', 'Main\QuestionController@destroyImageWhy')->name('DeleteImageWhy');
        Route::get('Questions', 'Main\MainController@Questions')->name('Questions');


        // About Us Edition
        Route::get('AboutUs', 'Main\AboutUsController@edit')->name('AboutUs.edit');
        Route::put('AboutUs.update', 'Main\AboutUsController@update')->name('AboutUs.update');


        // Contact Us Edition
        Route::get('ContactUs', 'Main\ContactUsController@edit')->name('ContactUs.edit');
        Route::put('ContactUs.update', 'Main\ContactUsController@update')->name('ContactUs.update');


        // Home Page Edition
        Route::get('HomePage', 'Main\HomePageController@edit')->name('HomePage.edit');
        Route::put('HomePage.update', 'Main\HomePageController@update')->name('HomePage.update');
        Route::post('HomePage.publication', 'Main\HomePageController@publication')->name('HomePage.publication');


        // Settings
        Route::get('Settings/General', 'Main\MainController@SettingGeneral')->name('Settings.General');
        Route::post('Settings/Generalpost', 'Main\SettingsController@General')->name('Settings.General.post');
        Route::get('Settings/App', 'Main\MainController@App')->name('Settings.App');
        Route::post('Settings/Apppost', 'Main\SettingsController@App')->name('Settings.App.post');


        // PagesManager
        Route::get('PagesManager', 'Main\MainController@PagesManager')->name('PagesManager');
        Route::get('PagesManagerDelete/{id}', 'Pages\PageController@destroy')->name('PagesManagerDelete');
        Route::get('PagesManagerEdit/{id}', 'Pages\PageController@edit')->name('PagesManagerEdit');
        Route::post('PagesManagerUpdate', 'Pages\PageController@update')->name('PagesManagerUpdate');
        Route::post('PagesManagerAdd', 'Pages\PageController@store')->name('PagesManagerAdd');

        // PlansManager
        Route::get('PlansManager', 'Main\MainController@PlansManager')->name('PlansManager');
        Route::get('PlansManagerDelete/{id}', 'Plans\PlanController@destroy')->name('PlansManagerDelete');
        Route::get('PlansManagerEdit/{id}', 'Plans\PlanController@edit')->name('PlansManagerEdit');
        Route::post('PlansManagerUpdate', 'Plans\PlanController@update')->name('PlansManagerUpdate');
        Route::post('PlansManagerAdd', 'Plans\PlanController@store')->name('PlansManagerAdd');
    });
});



/*========== Advisor ROUTES ==========*/
Route::prefix('Advisors')->name('Advisors.')->group(function () {
    Route::post('EndReserve', '\App\Http\Controllers\Advisors\Main\MainController@EndReserve')->name('EndReserve');

    Route::namespace('Advisors')->group(function () {
        Route::namespace('Auth')->name('auth.')->group(function () {
            Route::get('Login', 'LoginController@Login')->name('Login');
            Route::post('AdvisorLoginpost', 'LoginController@AdvisorLoginpost')->name('Login.post');

        });
    });


    Route::group(['middleware' => 'MustBeAdvisor'], function () {

        Route::namespace('Advisors')->group(function () {
            // Just Views Returns In MainController
            Route::get('Dashboard', 'Main\MainController@Dashboard')->name('Dashboard');
            Route::get('NowAdviced', 'Main\MainController@NowAdviced')->name('NowAdviced');
            Route::get('FuturistAdvice', 'Main\MainController@FuturistAdvice')->name('FuturistAdvice');
            Route::get('Conversations', 'Main\MainController@Conversations')->name('Conversations');
            Route::get('Chats', 'Main\MainController@Chats')->name('Chats');
            Route::get('Transaction', 'Main\MainController@Transactions')->name('Transactions');
            Route::get('BuyPlans', 'Main\MainController@BuyPlan')->name('BuyPlan');
            Route::get('BuyPlan/{id}', 'Plans\PlanController@Buy')->name('BuyPlanc');
            Route::get('StartReserve/{id}', 'Main\MainController@StartReserve')->name('StartReserve');



            Route::get('Support', 'Main\MainController@Support')->name('Support');
            Route::get('SetAdvisesTime', 'Main\MainController@SetAdvisesTime')->name('SetAdvisesTime');
            Route::post('SetAdvisesTime/create', 'Main\MainController@SetAdvisesTime_create')->name('SetAdvisesTime.create');
            Route::post('SetAdvisesTime/delete', 'Main\MainController@SetAdvisesTime_delete')->name('SetAdvisesTime.delete');
            Route::post('RequestWithdraw', 'Payment\PaymentController@RequestWithdraw')->name('RequestWithdraw');


            // Profile
            Route::get('Profile', 'Main\MainController@Profile')->name('Profile');
            Route::post('ProfileImage/update', 'Main\ProfileController@ProfileImageUpdate')->name('ProfileImage.update');
            Route::post('ProfileVideo/update', 'Main\ProfileController@ProfileVideoUpdate')->name('ProfileVideo.update');
            Route::put('ProfileInfo/update', 'Main\ProfileController@ProfileInfoUpdate')->name('ProfileInfo.update');
            Route::put('ProfileBio/update', 'Main\ProfileController@ProfileBioUpdate')->name('ProfileBio.update');
            Route::post('SetOnline', 'Main\ProfileController@SetOnline')->name('SetOnline');
            Route::post('UnsetOnline', 'Main\ProfileController@UnsetOnline')->name('UnsetOnline');
        });
        Route::resource('Supports', 'Support\SupportController');
    });
});
// Login Area



/*========== User ROUTES ==========*/
Route::prefix('Users')->name('Users.')->middleware('MustBeUser')->group(function () {
    // Just Views Returns In MainController
    Route::namespace('Users')->group(function () {
        Route::get('Dashboard', 'Main\MainControllerUser@Dashboard')->name('Dashboard');
        Route::post('Share', 'Main\MainControllerUser@Share')->name('Share');
        Route::get('NowAdviced', 'Main\MainControllerUser@NowAdviced')->name('NowAdviced');
        Route::get('FuturistAdvice', 'Main\MainControllerUser@FuturistAdvice')->name('FuturistAdvice');
        Route::get('Conversations', 'Main\MainControllerUser@Conversations')->name('Conversations');
        Route::get('NoCommentedConversation/{ConversationId}', 'Main\MainControllerUser@NoCommentedConversation')->name('NoCommentedConversation');
        Route::post('AddCommentedConversation', 'Main\MainControllerUser@AddCommentedConversation')->name('AddCommentedConversation');
        Route::get('Transactions', 'Main\MainControllerUser@Transactions')->name('Transactions');
        Route::get('Support', 'Main\MainControllerUser@Support')->name('Support');
        Route::get('Assist', 'Main\MainControllerUser@Assist')->name('Assist');
        Route::get('ListAdvisors', 'Main\MainControllerUser@ListAdvisors')->name('ListAdvisors');
        Route::get('Chats', 'Main\MainControllerUser@Chat')->name('Chats');
        Route::post('AddWallet', 'Transections\TransectionsController@AddWallet')->name('AddWalletP');



        // Profile
        Route::get('Profile', 'Main\MainControllerUser@Profile')->name('Profile');
        Route::put('Profile', 'Main\ProfileController@Update')->name('Profile.Update');
        Route::post('ImageProfile', 'Main\ProfileController@ImageUpdate')->name('ProfileImage.Update');
        Route::post('VerifyEmail', 'Main\ProfileController@VerifyEmail')->name('VerifyEmail');
        Route::post('SendCodeEmail', 'Main\ProfileController@SendCodeEmail')->name('SendCodeEmail');
    });

    Route::resource('Supports', 'Support\SupportController');
});
