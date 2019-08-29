<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::group(['middleware' => ['web']], function () {

  Route::get('/logout',"Auth\LoginController@logout");
  Route::group(['middleware' => ['guest']], function () {
    Route::post('/login',"Auth\LoginController@login");
    Route::get('/sign', function () {return view('member/sign');});
    Route::post('/register', 'UserSite\RegisterController@createUser');
    Route::get('/verify/{token}', 'UserSite\RegisterController@verifyEmail');
    Route::get('/forget','UserSite\ForgotPasswordController@showForgotPassword');
    Route::post('/forget','UserSite\ForgotPasswordController@sendResetLink');
    Route::get('/forget/{token}','UserSite\ForgotPasswordController@showResetPassoword');
    Route::post('/reset/password','UserSite\ForgotPasswordController@resetPassword');
  });

  Route::get('/cart', "UserSite\CartController@showCart");
  Route::post('/cart', "UserSite\CartController@addToCart");
  Route::post('/cart/edit', "UserSite\CartController@addToCart");
  Route::post('/cart/delete', "UserSite\CartController@deleteCart");
  Route::get('/cart-empty', function () {return view('checkout/cart-empty');});

  Route::post('/newsletter/subscribe', 'UserSite\IndexController@saveNewsletter');


  Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserSite\MemberController@showProfile');
    Route::post('/profile/save', 'UserSite\MemberController@saveProfile');
    Route::get('/district/get/{id}', 'UserSite\MemberController@getDistrict');
    Route::get('/wishlist', 'UserSite\MemberController@showWishlist');
    Route::post('/wishlist/delete', 'UserSite\MemberController@deleteWishlist');
    Route::get('/order', 'UserSite\MemberController@showOrderHistory');
    Route::get('/confirm-payment', 'UserSite\MemberController@showConfirmPayment');
    Route::post('/confirm-payment/save', 'UserSite\MemberController@saveConfirmPayment');
    Route::get('/confirm-payment/{order_no}', 'UserSite\MemberController@showConfirmPayment');
    Route::get('/order-detail/{order_no}', 'UserSite\MemberController@showOrderHistoryDetail');
    Route::get('/order-detail', function () {return view('member/order-detail');});
    Route::get('/newsletter', 'UserSite\MemberController@showNewsletter');
    Route::post('/newsletter/save', 'UserSite\MemberController@saveNewsletter');
    Route::get('/change-password', function () {return view('member/change-password');});
    Route::post('/change-password/save', 'UserSite\MemberController@changePassword');
    Route::get('/checkout','UserSite\CheckoutController@preCheckout');
    Route::group(['middleware' => ['cart','verified']], function () {
      Route::post('/checkout/shipping'           ,'UserSite\CheckoutController@checkoutShipping');
      Route::get('/checkout/shipping'           ,'UserSite\CheckoutController@checkoutShipping');
      Route::get('/district/shipping/get/'  ,'UserSite\CheckoutController@getDistrictShipping');
      Route::get('/district/billing/get/{id}'   ,'UserSite\CheckoutController@getDistrictBilling');
      Route::post('/checkout/getjneprice'   ,'UserSite\CheckoutController@getJnePrice');
      Route::post('/checkout/shipping-method','UserSite\CheckoutController@shippingMethod');
      Route::post('/checkout/payment','UserSite\CheckoutController@checkoutPayment');
      Route::post('/checkout/review','UserSite\CheckoutController@checkoutReview');
      Route::post('/checkout/create','UserSite\CheckoutController@checkoutCreate');
    });
    Route::get('/checkout/success/{order_id}','UserSite\CheckoutController@checkoutSuccess');
  });

  Route::get('/',"UserSite\IndexController@showIndex");
  Route::get('/about', "UserSite\IndexController@showAbout");
  Route::get('/terms-conditions', "UserSite\IndexController@showTerm");
  Route::get('/contact', "UserSite\IndexController@showContact");
  Route::post('/contact/submit', "UserSite\IndexController@saveContact");



  Route::get('/career', "UserSite\IndexController@showCarrer");

  Route::get('/article', "UserSite\IndexController@showArticle");
  Route::get('/article-detail/{slug}', "UserSite\IndexController@showArticleDetail");

  Route::get('/category', "UserSite\IndexController@showCategory");
  Route::get('/product', "UserSite\ProductController@showProduct");
  Route::get('/product/{category}', "UserSite\ProductController@showProduct");
  Route::get('/product/{category}/{subcategory}', "UserSite\ProductController@showProduct");
  Route::get('/product-detail', function () {return view('product-detail');});

  Route::get('/product-detail/{slug}', "UserSite\ProductController@showProductDetail");
  Route::get('/product-detail/{slug}/{cart_id}', "UserSite\ProductController@showProductDetail");
  Route::post('wishlist/save', "UserSite\ProductController@addToWishlist");

  Route::get('/search', "UserSite\ProductController@showProduct");
  Route::get('/search-empty', function () {return view('search-empty');});

  /* -- ADMIN -- */
  Route::group(['middleware' => ['administrator.guest']], function () {
    Route::get('/administratoronly', function () {return view('administratoronly/login');});
    Route::post('/administratoronly/login', 'AdministratorAuth\LoginController@login');
  });
  Route::group(['middleware' => ['administrator']], function () {
    Route::get('administratoronly/setdata', 'AdminSite\DataController@setAdminData');
    Route::any('administratoronly/logout', 'AdministratorAuth\LogoutController@logoutToPath');
    Route::get('/administratoronly/dashboard', 'AdminSite\DashboardController@showDashboard');
    Route::post('/administratoronly/export', 'AdminSite\DashboardController@exportToExcel');

    /*website*/
    Route::get('/administratoronly/website/slider', 'AdminSite\SliderController@showSlider');
    Route::post('/administratoronly/website/slider/add', 'AdminSite\SliderController@addSlider');
    Route::post('/administratoronly/website/slider/edit', 'AdminSite\SliderController@editSlider');
    Route::post('/administratoronly/website/slider/delete', 'AdminSite\SliderController@deleteSlider');

    Route::get('/administratoronly/website/newsletter', 'AdminSite\NewsletterController@showNewsletter');
    Route::post('/administratoronly/website/newsletter/send', 'AdminSite\NewsletterController@sendNewsletter');
    Route::post('/administratoronly/website/newsletter/unsubscribe', 'AdminSite\NewsletterController@unsubscribe');

    /*pages*/
    Route::get('/administratoronly/website/pages', 'AdminSite\PageController@showPage');
    Route::get('/administratoronly/website/pages/view/{id}', 'AdminSite\PageController@viewPage');
    Route::get('/administratoronly/website/pages/edit/{id}', 'AdminSite\PageController@editPage');
    Route::post('/administratoronly/website/pages/edit/{id}/save', 'AdminSite\PageController@saveEditPage');


    Route::get('/administratoronly/website/contact', 'AdminSite\ContactController@showContact');
    Route::post('/administratoronly/website/contact/edit', 'AdminSite\ContactController@editContact');
    Route::post('/administratoronly/website/contact/delete', 'AdminSite\ContactController@deleteContact');


    /*career*/
    Route::get('/administratoronly/website/career', 'AdminSite\CareerController@showCareer');
    Route::post('/administratoronly/website/career/save', 'AdminSite\CareerController@savePage');
    Route::get('/administratoronly/website/career/view/{id}', 'AdminSite\CareerController@viewCareer');
    Route::get('/administratoronly/website/career/add', 'AdminSite\CareerController@addCareer');
    Route::post('/administratoronly/website/career/add/save', 'AdminSite\CareerController@saveCareer');
    Route::get('/administratoronly/website/career/edit/{id}', 'AdminSite\CareerController@editCareer');
    Route::post('/administratoronly/website/career/edit/{id}/save', 'AdminSite\CareerController@saveEditCareer');
    Route::post('/administratoronly/website/career/delete', 'AdminSite\CareerController@deleteCareer');

    /*article*/
    Route::get('/administratoronly/website/article', 'AdminSite\ArticleController@showArticle');
    Route::get('/administratoronly/website/article/view/{id}', 'AdminSite\ArticleController@viewArticle');
    Route::get('/administratoronly/website/article/edit/{id}', 'AdminSite\ArticleController@editArticle');
    Route::post('/administratoronly/website/article/edit/{id}/save', 'AdminSite\ArticleController@saveEditArticle');
    Route::post('/administratoronly/website/article/delete', 'AdminSite\ArticleController@deleteArticle');
    Route::get('/administratoronly/website/article/add', 'AdminSite\ArticleController@addArticle');
    Route::post('/administratoronly/website/article/add/save', 'AdminSite\ArticleController@saveAddArticle');


    /*commerces*/
    Route::get('/administratoronly/commerce/store/category', 'AdminSite\CategoryController@showCategory');
    Route::post('/administratoronly/commerce/store/category/add', 'AdminSite\CategoryController@addCategory');
    Route::post('/administratoronly/commerce/store/category/edit', 'AdminSite\CategoryController@editCategory');
    Route::post('/administratoronly/commerce/store/category/delete', 'AdminSite\CategoryController@deleteCategory');

    Route::get('/administratoronly/commerce/store/subcategory', 'AdminSite\CategoryController@showSubcategory');
    Route::post('/administratoronly/commerce/store/subcategory/save', 'AdminSite\CategoryController@saveSubcategory');
    Route::post('/administratoronly/commerce/store/subcategory/edit', 'AdminSite\CategoryController@editSubcategory');
    Route::post('/administratoronly/commerce/store/subcategory/delete', 'AdminSite\CategoryController@deleteSubcategory');


    Route::get('/administratoronly/commerce/product/', 'AdminSite\ProductController@showProduct');
    Route::get('/administratoronly/commerce/product/add', 'AdminSite\ProductController@showAddProduct');
    Route::post('/administratoronly/commerce/product/add/save', 'AdminSite\ProductController@saveProduct');
    Route::get('/administratoronly/commerce/product/view/{id}', 'AdminSite\ProductController@viewProduct');
    Route::get('/administratoronly/commerce/product/edit/{id}', 'AdminSite\ProductController@showEditProduct');
    Route::post('/administratoronly/commerce/product/delete', 'AdminSite\ProductController@deleteProduct');
    Route::post('/administratoronly/commerce/product/edit/{id}/save', 'AdminSite\ProductController@editProduct');
    Route::post('/administratoronly/commerce/product/edit/{id}/editdetail', 'AdminSite\ProductController@editDetail');
    Route::post('/administratoronly/commerce/product/edit/{id}/addcolor', 'AdminSite\ProductController@addColor');
    Route::post('/administratoronly/commerce/product/edit/{id}/deletecolor', 'AdminSite\ProductController@deleteColor');



    Route::get('/administratoronly/commerce/member/','AdminSite\MemberController@showMember');
    Route::post('/administratoronly/commerce/member/resendactivactionemail','AdminSite\MemberController@resendActivationMail');
    Route::get('/administratoronly/commerce/member/view/{id}','AdminSite\MemberController@viewMember');
    Route::get('/administratoronly/commerce/member/view-order/{order_no}','AdminSite\MemberController@viewMemberOrder');

    Route::get('/administratoronly/commerce/order/', 'AdminSite\OrderController@showOrder');
    Route::post('/administratoronly/commerce/order/confirmpayment', 'AdminSite\OrderController@confirmPayment');
    Route::post('/administratoronly/commerce/order/cancelpayment', 'AdminSite\OrderController@cancelPayment');
    Route::post('/administratoronly/commerce/order/tracking', 'AdminSite\OrderController@tracking');
    Route::get('/administratoronly/commerce/order/view/{id}', 'AdminSite\OrderController@showOrderDetail');
    Route::get('/administratoronly/commerce/order/invoice/{id}', 'AdminSite\OrderController@showInvoice');
    Route::post('/administratoronly/commerce/order/delete', 'AdminSite\OrderController@deleteOrder');


    Route::get('/administratoronly/commerce/order/view-order', function () {return view('administratoronly/commerce/order/view-order');});

    Route::get('/administratoronly/commerce/payment/','AdminSite\PaymentController@showPayment');
    Route::get('/administratoronly/commerce/payment/view','AdminSite\PaymentController@viewPayment');
    Route::get('/administratoronly/commerce/shipping/', function () {return view('administratoronly/commerce/shipping/index');});
    Route::get('/administratoronly/commerce/others','AdminSite\OtherController@showOther');
    Route::post('/administratoronly/commerce/others/save','AdminSite\OtherController@saveOther');

    /*settings*/
    Route::get('/administratoronly/settings/metadata/index','AdminSite\SettingController@showMetadata');
    Route::post('/administratoronly/settings/metadata/save','AdminSite\SettingController@saveMetadata');
    Route::get('/administratoronly/settings/social-media/index','AdminSite\SettingController@showSocialMedia');
    Route::post('/administratoronly/settings/social-media/save','AdminSite\SettingController@saveSocialMedia');
    Route::get('/administratoronly/settings/tools/index','AdminSite\SettingController@showTool');
    Route::post('/administratoronly/settings/tools/save','AdminSite\SettingController@saveTool');
    Route::get('/administratoronly/settings/useraccount/account/index','AdminSite\SettingController@showAccount');
    Route::post('/administratoronly/settings/useraccount/account/add','AdminSite\SettingController@addAccount');
    Route::post('/administratoronly/settings/useraccount/account/edit','AdminSite\SettingController@editAccount');
    Route::post('/administratoronly/settings/useraccount/account/delete','AdminSite\SettingController@deleteAccount');
    Route::get('/administratoronly/settings/useraccount/group/index','AdminSite\SettingController@showGroup');
    Route::get('/administratoronly/settings/useraccount/group/add','AdminSite\SettingController@showAddGroup');
    Route::post('/administratoronly/settings/useraccount/group/add/save','AdminSite\SettingController@addRoleGroup');
    Route::get('/administratoronly/settings/useraccount/group/edit/{id}','AdminSite\SettingController@showEditGroup');
    Route::post('/administratoronly/settings/useraccount/group/edit/{id}/save','AdminSite\SettingController@saveEditGroup');
    Route::post('/administratoronly/settings/useraccount/group/delete','AdminSite\SettingController@deleteRoleGroup');
    Route::get('/administratoronly/settings/change-password/index', function () {return view('administratoronly/settings/change-password/index');});
    Route::post('/administratoronly/settings/change-password/save','AdminSite\SettingController@saveChangePassword');
  });
});

/* Testing mail */

Route::get('/mail/contactus', function () { return new App\Mail\User\Contact_us(""); });
Route::get('/mail/order/{order_no}','UserSite\CheckoutController@testOrderMail');
Route::get('/mail/adminorder/{order_no}','UserSite\CheckoutController@testAdminOrderNotifMail');
Route::get('/mail/expireorder/{order_no}','UserSite\CheckoutController@tesExpireOrderMail');
Route::get('/mail/reminderorder/{order_no}','UserSite\CheckoutController@testReminderOrderMail');
Route::get('/mail/test', function () { return new App\Mail\testemail;});

Route::get('/mail/admincontactus', function () {
  $data=["full_name"=>"dummy","email"=>"dummy_email","topic"=>"1","message"=>"the message"];
  return new App\Mail\Administrator\Contact_us($data);
});

/**/

//Clear Cache facade value:
Route::get('/cache-clear', function() {
  $exitCode = Artisan::call('cache:clear');
  return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
  $exitCode = Artisan::call('optimize');
  return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
  $exitCode = Artisan::call('route:cache');
  return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
  $exitCode = Artisan::call('route:clear');
  return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
  $exitCode = Artisan::call('view:clear');
  return '<h1>View cache cleared</h1>';
});

Route::get('/reminderorder', function() {
  $exitCode = Artisan::call('ReminderOrder:run');
});

Route::get('/reminderorder23', function() {
  $exitCode = Artisan::call('ReminderOrder23:run');
});

Route::get('/expireorder', function() {
  $exitCode = Artisan::call('ExpireOrder:run');
});

//Clear Config cache:
Route::get('/config-cache', function() {
  $exitCode = Artisan::call('config:cache');
  return '<h1>Clear Config cleared</h1>';
});
