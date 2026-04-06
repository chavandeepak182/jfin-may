<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\MlmController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\EligibilityCriteriaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CibilController;
use App\Http\Controllers\AuthV2Controller;
use App\Http\Controllers\MisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PropertyTakerController;
use App\Http\Controllers\ChatbotLeadController;
use Illuminate\Support\Facades\Route;
use App\Exports\EligibilityExport;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuthV3\AuthV3Controller;
use App\Http\Controllers\EstimatedFileController;
use App\Http\Controllers\MonthlyPLController;
use Illuminate\View\ViewException;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketMessageController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\VisitEnquiryController;
use App\Http\Controllers\AuthV3\PropertyAuthController;
use App\Http\Controllers\DsaController;
use App\Http\Controllers\PriceRangeController;
use App\Http\Controllers\DsaPayoutConfigController;
use App\Http\Controllers\DsaPayoutController;



// admin 
Route::get('/admin/change-password', [AdminController::class, 'changePasswordForm'])->name('admin.change.password');
Route::post('/admin/change-password', [AdminController::class, 'updatePassword'])->name('admin.update.password');


// refreal leads city
Route::get('/get-cities/{state_id}', function ($state_id) {
    return DB::table('cities')
        ->where('state_id', $state_id)
        ->select('id', 'city')
        ->orderBy('city')
        ->get();
})->name('get.cities');


require __DIR__.'/auth.php';
// dashbord path
Route::get('/admin/customers', [UsersController::class, 'adminCustomer'])
    ->name('admin.customers');
// update user
// reset pass user
Route::post('/admin/reset-password', [UsersController::class, 'resetPassword'])
     ->name('admin.reset.password');


Route::post('/admin/user/update-status',
    [UsersController::class, 'updateUserStatus']
)->name('update.user.status');

Route::get('admin/loans-list', [LoanApplicationController::class, 'loanlist'])->name('admin.loans');
Route::get('admin/property', [PropertyController::class, 'propertylist'])->name('admin.property');
Route::get('admin/leadslist', [LeadController::class, 'leadlist'])->name('admin.listlead');
Route::post('/update-featured', [PropertyController::class,'updateFeatured'])->name('updateFeatured');
Route::get('admin/banklist', [BankController::class, 'loanbankslist'])->name('admin.bank');
Route::post('/admin/loan-bank/store', [BankController::class, 'insertLoanBank'])
    ->name('admin.loanbank.store');
Route::get('admin/referrallist', [BankController::class, 'listreferral'])->name('admin.allreferral');
Route::get('admin/eligible', [BankController::class, 'eligiblelist'])->name('admin.eligible');

 Route::get('admin/dashboard_test', [AdminController::class, 'dashboard_test'])->name('dashboard_test');

Route::get('/', function () {
    return view('dhara-jfin.index');
});
// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('/about',function () {
    return view('dhara-jfin.about');
    });
// Route::get('about', [FrontendController::class, 'AboutView']);


Route::get('/home-loan',function () {
    return view('dhara-jfin.home-loan');
    });
// Route::get('home-loan', [FrontendController::class, 'HomeLoanView']);


Route::get('/project-loan',function () {
    return view('dhara-jfin.project-loan');
    });
// Route::get('project-loan', [FrontendController::class, 'ProjectLoanView']);

Route::get('/msme-loan',function () {
    return view('dhara-jfin.msme-loan');
    });
// Route::get('msme-loan', [FrontendController::class, 'MSMELoanView']);


Route::get('/loan-against-property',function () {
    return view('dhara-jfin.loan-against-property');
    });
// Route::get('loan-against-property', [FrontendController::class, 'LAPLoanView']);

Route::get('/overdraft-facility',function () {
    return view('dhara-jfin.overdraft-facility');
    });
// Route::get('overdraft-facility', [FrontendController::class, 'OverdraftLoanView']);


Route::get('/lease-rental-discounting',function () {
    return view('dhara-jfin.lease-rental-discounting');
    });
// Route::get('lease-rental-discounting', [FrontendController::class, 'LRDLoanView']);


Route::get('/eligibility-calculator',function () {
    return view('dhara-jfin.calculator');
    })->name('eligibility.calculator');

//     Route::get('/eligibility-calculator', function () {
//     return view('frontend.eligibility_calcultor');
// })->name('eligibility.calculator');

Route::get('/services',function () {
    return view('dhara-jfin.services');
    });
// Route::get('services', [FrontendController::class, 'ServicesView']);

Route::get('/contact',function () {
    return view('dhara-jfin.contact');
    });
 Route::get('emailtest', [FrontendController::class, 'emailtest']);

Route::get('/privacy-policy',function () {
    return view('dhara-jfin.privacy');
    });
// Route::get('privacy-policy', [FrontendController::class, 'PrivacyView']);

Route::get('/terms-and-conditions',function () {
    return view('dhara-jfin.terms_and_cond');
    });
    Route::get('/prop',function () {
    return view('dhara-jfin.properties');
    });
// Route::get('terms-and-conditions', [FrontendController::class, 'TermCondView']);

// Route::get('/dhara-apply',function () {
//     return view('dhara-jfin.apply');
//     });
//  demo login



/* ================= AUTH V3 ================= */

// Route::get('/authv3/signup', [AuthV3Controller::class, 'signupForm'])
//     ->name('authv3.signup.form');

// Route::post('/authv3/signup', [AuthV3Controller::class, 'signupSubmit'])
//     ->name('authv3.signup.submit');

// Route::get('/authv3/login', [AuthV3Controller::class, 'loginForm'])
//     ->name('authv3.login.form');

// Route::post('/authv3/login', [AuthV3Controller::class, 'loginSubmit'])
//     ->name('authv3.login.submit');

// Route::get('/authv3/verify-otp', [AuthV3Controller::class, 'otpForm'])
//     ->name('authv3.otp.form');

// Route::post('/authv3/verify-otp', [AuthV3Controller::class, 'verifyOtp'])
//     ->name('authv3.otp.verify');

// Route::get('/authv3/resend-otp', [App\Http\Controllers\AuthV3\AuthV3Controller::class, 'resendOtp'])
//     ->name('authv3.otp.resend');


/* ================= AUTH V3 ================= */

// Signup
Route::get('/authv3/signup', [AuthV3Controller::class, 'signupForm'])
    ->name('authv3.signup.form');

Route::post('/authv3/signup', [AuthV3Controller::class, 'signupSubmit'])
    ->name('authv3.signup.submit');

// Login form
Route::get('/authv3/login', [AuthV3Controller::class, 'loginForm'])
    ->name('authv3.login.form');

// ✅ Email + Password Login
Route::post('/authv3/login/email', [AuthV3Controller::class, 'loginWithEmail'])
    ->name('authv3.login.email');

// ✅ Mobile OTP Login (Send OTP)
Route::post('/authv3/login/otp', [AuthV3Controller::class, 'loginWithOtp'])
    ->name('authv3.login.otp');

// OTP Verify
Route::get('/authv3/verify-otp', [AuthV3Controller::class, 'otpForm'])
    ->name('authv3.otp.form');

Route::post('/authv3/verify-otp', [AuthV3Controller::class, 'verifyOtp'])
    ->name('authv3.otp.verify');

// Resend OTP
Route::get('/authv3/resend-otp', [AuthV3Controller::class, 'resendOtp'])
    ->name('authv3.otp.resend');

Route::get('/authv3/google', [AuthV3Controller::class, 'redirectToGoogle'])
    ->name('authv3.google.login');

Route::get('/authv3/google/callback', [AuthV3Controller::class, 'handleGoogleCallback'])
    ->name('authv3.google.callback');

// property





// forgot password


Route::get('/forgot-password', [AuthV3Controller::class, 'forgotForm'])
    ->name('authv3.forgot.form');

Route::post('/forgot-password', [AuthV3Controller::class, 'forgotSubmit'])
    ->name('authv3.forgot.submit');

Route::get('/reset-password', [AuthV3Controller::class, 'resetForm'])
    ->name('authv3.reset.form');

Route::post('/reset-password', [AuthV3Controller::class, 'resetPassword'])
    ->name('authv3.reset.submit');





/* ===== PROPERTY AUTH ===== */
Route::get('/property/login', [PropertyAuthController::class, 'loginForm'])
    ->name('property.login');

Route::get('/property/signup', [PropertyAuthController::class, 'signupForm'])
    ->name('property.signup');

Route::post('/property/signup', [PropertyAuthController::class, 'signupSubmit'])
    ->name('property.signup.submit');

Route::post('/property/login/otp', [PropertyAuthController::class, 'loginWithOtp'])
    ->name('property.login.otp');

Route::get('/property/verify-otp', [PropertyAuthController::class, 'otpForm'])
    ->name('property.otp.form');

Route::post('/property/verify-otp', [PropertyAuthController::class, 'verifyOtp'])
    ->name('property.otp.verify');

// Route::get('/properties', [FrontendController::class, 'properties'])
//     ->middleware('auth')
//     ->name('properties');


//  login

// Route::get('/signup-v2', function () {
//     return view('auth-v2.signup_v2');
// });

// Route::get('/login-mobile', function () {
//     return view('auth-v2.mobile_login');
// });


// Route::post('/register-v2', [AuthV2Controller::class, 'registerUserV2']);
// Route::post('/send-otp-v2', [AuthV2Controller::class, 'sendOtpV2']);
// Route::post('/verify-otp-v2', [AuthV2Controller::class, 'verifyOtpV2']);

// Route::get('/verify-otp', function () {
//     return view('auth-v2.verify_otp');
// });


// demo

// Email + Password login
//  login
// pages
Route::get('/signup-v2', function () {
    return view('auth-v2.signup_v2');
});

Route::get('/login-mobile', function () {
    return view('auth-v2.mobile_login');
});

// form submit
Route::post('/register-v2', [AuthV2Controller::class, 'registerUserV2']);
Route::post('/send-otp-v2', [AuthV2Controller::class, 'sendOtpV2']);
Route::post('/verify-otp-v2', [AuthV2Controller::class, 'verifyOtpV2']);
/* OTP Pages */
Route::get('/verify-otp', function () {
    return view('auth-v2.verify_otp');
});



// serachbar referal leads 
Route::get('/admin/referral/ajax',
    [LeadController::class, 'referralAjax']
)->name('admin.referral.ajax');

Route::get('/admin/enquiry/ajax', [LeadController::class, 'enquiryAjax'])
    ->name('admin.enquiry.ajax');

Route::get('/admin/leads/ajax', [LeadController::class, 'leadsAjax'])
    ->name('admin.leads.ajax');

Route::get('/admin/mis/ajax', [LeadController::class, 'misAjax'])
    ->name('admin.mis.ajax');



    // Route::get('/logout', [AuthV2Controller::class, 'logout']);


// blog

Route::get('/admin/blog', [BlogController::class, 'adminBlog'])->name('admin.blogs');
Route::get('/blogs/{slug}', [FrontendController::class, 'showBlog'])->name('blogs.show');
Route::get('/blogs', [FrontendController::class, 'blog'])->name('blogs');

Route::get('admin/blogs', [BlogController::class, 'index'])->name('blogs.index');          // List blogs
   Route::get('admin/blog/create', [BlogController::class, 'create'])->name('blogs.create'); // Add blog form
    Route::post('blogs/store', [BlogController::class, 'storeService'])->name('blogs.store'); // Save blog
    Route::get('blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');  // Edit blog form
    Route::put('blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update'); // Update blog
    Route::post('blogs/delete/{id}', [BlogController::class, 'deleteService'])->name('blogs.delete'); // Delete blog


    // blog category
    Route::get('/blog-categories', [BlogCategoryController::class, 'index'])->name('blog.categories.index');
Route::post('/blog-categories/store', [BlogCategoryController::class, 'store'])->name('blog.categories.store');
Route::get('/blog-categories/edit/{pid}', [BlogCategoryController::class, 'edit'])->name('blog.categories.edit');
Route::post('/blog-categories/update/{pid}', [BlogCategoryController::class, 'update'])->name('blog.categories.update');

Route::middleware('isAdmin')->group(function () {
    Route::post('/blog-categories/delete/{pid}', [BlogCategoryController::class, 'destroy'])
        ->name('blog.categories.delete');
});



//permission
    Route::prefix('admin')->group(function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
//roles
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class,'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class,'givePermissionToRole']);
//users
    Route::resource('users', App\Http\Controllers\UsersController::class);
    Route::get('users/{UserId}/delete', [App\Http\Controllers\UsersController::class, 'destroy']);
//enquiry
    Route::get('/enquiries', [EnquiryController::class, 'enquiryLead'])->name('enquiries.enquiryLead');
    Route::get('/book-visit/leads', [VisitEnquiryController::class, 'index'])
    ->name('bookvisit.leads');
    Route::post('/book-visit/assign-lead', [VisitEnquiryController::class, 'assign'])
    ->middleware(['auth'])
    ->name('bookvisit.assign');
    
    

//category
    Route::resource('/category', App\Http\Controllers\CategoryController::class);    
    });

    Route::prefix('admin')->group(function () {
        Route::get('/tree', [CategoryController::class, 'showTree'])->name('admin.tree.show');
    });
    
    Route::middleware([isUser::class])->group(function () {
        Route::get('/child-nodes', [MlmController::class, 'getAllChildNodes'])->name('user.childNodes');
        Route::get('/loans-by-child', [MlmController::class, 'getLoansByChild'])->name('loans.by.child');
    });




Route::get('test', [FrontendController::class, 'TestView']);
Route::get('registration', [FrontendController::class, 'RegisterView']);
Route::get('myprofile', [FrontendController::class, 'ProfileView']);
Route::get('emi-calculator', [FrontendController::class, 'CalculatorView']);
Route::get('properties', [FrontendController::class, 'properties'])->name('properties');
// Route::get('property-details/{property_id}', [FrontendController::class, 'PropDetailsView']);
Route::get('/property-details/{id}', function ($id) {
    $property = DB::table('properties')->where('properties_id', $id)->first();

    if ($property && isset($property->slug)) {
        $slugAndId = $property->slug . '-' . $property->properties_id;
        return redirect("/$slugAndId", 301);
    }

    abort(404);
});
// Route::get('/{slugAndId}', [FrontendController::class, 'PropDetailsView'])->name('property.details');
Route::get('/property/{slug}', [FrontendController::class, 'propertyBySlug'])->name('property.slug');
Route::get('referral-program', [FrontendController::class, 'ReferralsView']);

Route::post('search_properties', [FrontendController::class, 'search_properties'])->name('search_properties');


// Loan Application Routes
Route::get('professional-detail', [FrontendController::class, 'ProfessionalDetailView']);





// DSA SECTION
Route::get('/admin/dsa', [DsaController::class, 'index'])->name('admin.dsa');
Route::get('/admin/dsa/list', [DsaController::class, 'getList'])->name('admin.dsa.list');
Route::post('/admin/dsa/store', [DsaController::class, 'store'])->name('admin.dsa.store');

//user routes
Route::get('login', [AdminController::class, 'loginView'])->name('login');
Route::post('a', [FrontendController::class, 'userLogin'])->name('userLogin');

// Route::get('verify-otp', [AdminController::class, 'verifyOtp'])->name('verify-otp');

// Route::post('submit-otp', [AdminController::class, 'postVerifyOtp'])->name('submit-otp');


// Route::get('logout', [FrontendController::class, 'logout'])->name('logout');
Route::post('/logout', [FrontendController::class, 'logout'])->name('logout');

Route::get('forgot', [FrontendController::class, 'forgot'])->name('forgot');
Route::get('/activate', [FrontendController::class, 'activate'])->name('activate')->middleware('throttle:6,1');;

//reset password
Route::post('reset_password_link', [FrontendController::class, 'reset_password_link'])->name('reset_password_link');
Route::get('reset_password/{auth_id}', [FrontendController::class, 'reset_password'])->name('reset_password');
Route::post('update_password', [FrontendController::class, 'update_password'])->name('update_password');


// notification routes
Route::middleware(['auth'])->group(function () {
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');
});

Route::get('/cities/{state_id}', [LoanApplicationController::class, 'getCities'])->name('getCities');


//loan
// Route::get('/applyNow', [LoanApplicationController::class, 'applyNow'])->name('applyNow');
// Apply Now
Route::get('/applyNow', [LoanApplicationController::class, 'applyNow'])
    ->name('applyNow');
Route::get('/start_loan/{id}', [LoanApplicationController::class, 'start_loan'])->name('start_loan');

Route::middleware(['isUserOrAdmin'])->group(function () {
   
    Route::get('/loan-application', [LoanApplicationController::class, 'showForm'])->name('loan.form');
    Route::post('/fetch-credit-report', [LoanApplicationController::class, 'fetchReport']);
    Route::post('/loan-application/step', [LoanApplicationController::class, 'handleStep'])->name('loan.handle_step');
    Route::get('/thank-you', [LoanApplicationController::class, 'thankYou'])->name('loan.thankyou');
    Route::get('/error', [LoanApplicationController::class, 'Error'])->name('loan.error');
    Route::get('/loan-getback', [LoanApplicationController::class, 'getBack'])->name('loan.getback');
    Route::post('/check-referral-code', [LoanApplicationController::class, 'checkReferralCode'])->name('check.referral_code');
    Route::get('/my-profile', [UsersController::class, 'showProfile'])->name('loan.profile');
    Route::get('/myloans', [UsersController::class, 'myloans'])->name('loan.myloans');
    Route::get('/loans-list', [UsersController::class, 'myLoanList'])->name('loans.loans-list');
    Route::get('/mypersonal', [UsersController::class, 'mydetails'])->name('loan.mypersonal');
    Route::get('/get-cities/{stateId}', [UsersController::class, 'getCities']);

    Route::get('/myprofessional', [UsersController::class, 'myprofessional'])->name('loan.myprofessional');
    Route::get('/myeducation', [UsersController::class, 'myeducation'])->name('loan.myeducation');
    Route::get('/mydocuments', [UsersController::class, 'mydocuments'])->name('loan.mydocuments');
    Route::post(
    '/loan/document/replace/{id}',
    [UsersController::class, 'replaceDocument']
)->name('loan.replaceDocument');

    Route::delete('/mydocuments/{id}', [UsersController::class, 'deleteDocument'])
    ->name('loan.deletedocument');

    Route::post('/update-documents', [UsersController::class, 'updateDocuments'])->name('loan.update_documents');
    Route::put('/my-profile/update', [UsersController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update', [UsersController::class, 'updateUserProfile'])->name('user.profile.update');
    Route::post('/professional/update', [UsersController::class, 'updateUserProfessional'])->name('user.professional.update');
    Route::post('/educational/update', [UsersController::class, 'updateUserEducational'])->name('user.educational.update');
    Route::get('agent/approved-loans', [LoanApplicationController::class, 'agentApproved'])->name('agent.approved.loans');
    Route::get('customer/loans', [UsersController::class, 'customerLoans'])->name('customer.loans');

    //wallet
    Route::get('user/walletbalance', [ReferralController::class, 'userWalletbalance'])->name('user.walletbalance');

    Route::get('loanedit/{id}', [LoanApplicationController::class, 'loanedit'])->name('loanedit');

    Route::post('updateLoan', [LoanApplicationController::class, 'update'])->name('updateLoan');

    // referlalead in cutomer
    Route::post(
    '/invite-referral-submit',
    [ReferralController::class, 'submitInviteReferral']
)->name('invite.referral.submit');


});
Route::get('/help-support', [UsersController::class, 'helpSupport'])
    ->name('user.help.support');


Route::middleware(['isAdmin'])->group(function () {

    Route::post('admin/updateLoan', [LoanApplicationController::class, 'update'])
        ->name('admin.updateLoan');
        Route::get('admin/profile/edit', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
Route::post('admin/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('admin/profile', [ProfileController::class, 'showProfile'])->name('admin.profile');

});







// customer bank add fun


Route::post('/user/bank/save', [UsersController::class, 'saveBankDetails'])
    ->name('user.bank.save');

//loan admin
Route::get('admin/loans', [LoanApplicationController::class, 'index'])->name('loans.index');
Route::post('admin/insertLoan', [LoanApplicationController::class, 'store'])->name('admin.insertLoan');
Route::post('admin/deleteLoan', [LoanApplicationController::class, 'destroy'])->name('deleteLoan');
Route::get('admin/editLoan/{id}', [LoanApplicationController::class, 'edit'])->name('editLoan');
Route::post('admin/updateLoan', [LoanApplicationController::class, 'update'])->name('admin.updateLoan');
Route::get('admin/loan/{id}', [LoanApplicationController::class, 'view'])->name('loan.view');
Route::get('admin/inprocess-loans', [LoanApplicationController::class, 'inprocess'])->name('inprocess.loans');
Route::get('admin/disbursed-loans', [LoanApplicationController::class, 'disbursed'])->name('disbursed.loans');
Route::get('admin/pending-loans', [LoanApplicationController::class, 'pendingLoans'])->name('pendingLoans');
Route::get('admin/approved-loans', [LoanApplicationController::class, 'approved'])->name('approvedLoans');
Route::get('admin/rejected-loans', [LoanApplicationController::class, 'rejected'])->name('rejectedLoans');
Route::get('/admin/trashed-loans', [LoanApplicationController::class, 'trashedLoans'])->name('trashed.loans');
Route::post('/admin/restoreLoan', [LoanApplicationController::class, 'restore'])->name('restoreLoan');

//loan agent
Route::get('agent/inprocess-loans', [LoanApplicationController::class, 'agentInprocess'])->name('agent.inprocess.loans');
Route::get('agent/approved-loans', [LoanApplicationController::class, 'agentApproved'])->name('agent.approved.loans');
Route::get('agent/rejected-loans', [LoanApplicationController::class, 'agentRejected'])->name('agent.rejected.loans');
Route::get('agent/documentpending-loans', [LoanApplicationController::class, 'agentDocumentPending'])->name('agent.documentpending.loans');
Route::get('agent/all-loans', [LoanApplicationController::class, 'allAgentLoans'])->name('agent.allAgentLoans');
Route::get('agent/editLoan/{id}', [AgentController::class, 'edit'])->name('agent.editLoan');
Route::post('agent/updateLoan', [AgentController::class, 'update'])->name('agent.updateLoan');
Route::get('agent/loan/{id}', [AgentController::class, 'view'])->name('agent.loan.view');
//Mis agent
Route::get('agent/mis', [AgentController::class, 'agentMis'])->name('agent.mis');
Route::get('agent/mis/{id}', [AgentController::class, 'viewMis'])->name('agent.mis.view');
//MIS ADMIN
Route::get('admin/mis', [AdminController::class, 'adminMis'])->name('admin.mis');
Route::get('admin/mis/{id}', [AdminController::class, 'viewMis'])->name('admin.mis.view');

Route::get('admin/addloans', [AdminController::class, 'addLoans'])->name('addloans');
Route::get('admin/create-loan', [AdminController::class, 'createLoans'])->name('admin.create-loan');
    Route::post('/admin/loan-application/step', [LoanApplicationController::class, 'submitLoanApplication'])->name('admin.handle_step');

Route::get('/loans/ajax/list', [LoanApplicationController::class, 'ajaxList'])
    ->name('loan.ajax.list');
    Route::get('/loans/ajax/pending', [LoanApplicationController::class, 'ajaxPendingLoans'])
    ->name('loan.ajax.pending');
    Route::get('/loans/ajax/inprocess',
    [LoanApplicationController::class, 'ajaxInprocessLoans']
)->name('loan.ajax.inprocess');
Route::get('/loans/ajax/trashed',
    [LoanApplicationController::class, 'ajaxTrashedLoans']
)->name('loan.ajax.trashed');
Route::get(
    '/loans/ajax/approved',
    [LoanApplicationController::class, 'ajaxApprovedLoans']
)->name('loan.ajax.approved');
Route::get(
    '/loans/ajax/disbursed',
    [LoanApplicationController::class, 'ajaxDisbursedLoans']
)->name('loan.ajax.disbursed');

Route::get(
    '/loans/ajax/rejected',
    [LoanApplicationController::class, 'ajaxRejectedLoans']
)->name('loan.ajax.rejected');

// agent ajax through
Route::get('/agent/assigned-loans-ajax', [LoanApplicationController::class, 'assignedLoansAjax'])
    ->name('agent.assignedLoans.ajax');
    Route::get('/agent/all-loans-ajax', [LoanApplicationController::class, 'allLoansAjax'])
    ->name('agent.allLoans.ajax');
    Route::get('/agent/inprocess-loans-ajax', 
    [LoanApplicationController::class, 'inProcessLoansAjax']
)->name('agent.inprocessLoans.ajax');

Route::get(
    '/agent/approved-loans-ajax',
    [LoanApplicationController::class, 'approvedLoansAjax']
)->name('agent.approvedLoans.ajax');
Route::get(
    '/agent/disbursed-loans-ajax',
    [LoanApplicationController::class, 'disbursedLoansAjax']
)->name('agent.disbursedLoans.ajax');


Route::post('/get-cities-property',[PropertyController::class,'getCities'])->name('getCitiesproperty');
Route::get('/get-cities/{state_id}', [AgentController::class, 'getCities']);

Route::get('/get-areas/{city_id}', [PropertyController::class, 'getAreas']);

//export
Route::get('/export-eligibility', function () {
    $data = [
        ['Field', 'Value'],
        ['Customer Name', 'John Doe'],
        ['Salary', '50000'],
        ['Tax Amount', '5000'],
        // Add other fields dynamically from your logic
    ];

    return Excel::download(new EligibilityExport($data), 'eligibility.xlsx');
})->name('export.eligibility');


//enquiry form
Route::get('enquiry', [EnquiryController::class, 'showForm'])->name('enquiry.form');
Route::post('/chatbot-leads', [ChatbotLeadController::class, 'store'])->name('chatbot.leads.store');
Route::post('enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
//register 
Route::post('register', [UsersController::class, 'register'])->name('register');
Route::post('/visit-enquiry-submit', [VisitEnquiryController::class, 'store'])
    ->name('visit.enquiry.submit');

Route::middleware('isAdmin')->group(function () {
Route::post('admin/insertUser',[UsersController::class,'insertUser'])->name('insertUser');
Route::get('/get-user-by-id', [UsersController::class, 'getUserById'])
    ->name('getUserById');

    Route::get('/admin/load-list-by-type', 
    [App\Http\Controllers\UsersController::class, 'loadListByType']
)->name('load.list.by.type');
Route::post('/admin/update-employee-status', [UsersController::class,'updateEmployeeStatus'])
    ->name('admin.update.employee.status')
    ;
    Route::post('/update-property-status',[PropertyController::class,'updatePropertyStatus'])
    ->name('updatePropertyStatus');



    Route::get('/editUser/{user_id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('/updateUser', [UsersController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser', [UsersController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/updateProfile', [UsersController::class, 'updateProfile'])->name('updateProfile');
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/admindashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('admin/addUser', [UsersController::class, 'addUser'])->name('addUser');
    Route::get('admin/allUsers', [UsersController::class, 'allUsers'])->name('allUsers');  
    Route::post('/update-user-status', [UsersController::class, 'updateUserStatus'])->name('updateUserStatus');
    Route::post('admin/s', [LoanApplicationController::class, 'assignAgent'])->name('assignAgent');
Route::post('/loan/restore', [LoanApplicationController::class, 'restoreLoan'])
    ->name('loan.restore');

    //activity list
    Route::get('admin/activities', [AdminController::class, 'activities'])->name('activities');  
  
    
    //referral
    Route::get('admin/referral_earnings', [ReferralController::class, 'referral_earnings'])->name('admin.referral_earnings');
    Route::get('/admin/refer-tool', [ReferralController::class, 'listUsers'])->name('admin.refer.tool');


    //bank 
    Route::get('admin/allbanks', [BankController::class, 'allbanks'])->name('allbanks');
    Route::post('bank/insertBank',[BankController::class,'insertBank'])->name('insertBank');
    Route::get('/editBank/{bank_id}', [BankController::class, 'editBank'])->name('editBank');
    Route::post('/updateBank', [BankController::class, 'updateBank'])->name('updateBank');
    Route::post('/deleteBank', [BankController::class, 'deleteBank'])->name('deleteBank');  
    //Bank loan
    Route::get('admin/loanbanks', [BankController::class, 'loanbanks'])->name('loanbanks');
    Route::post('bank/insertLoanBank',[BankController::class,'insertLoanBank'])->name('insertLoanBank');
    Route::get('/editLoanBank/{bank_id}', [BankController::class, 'editLoanBank'])->name('editLoanBank');
    Route::post('/updateLoanBank', [BankController::class, 'updateLoanBank'])->name('updateLoanBank');
    Route::post('/deleteLoanBank', [BankController::class, 'deleteLoanBank'])->name('deleteLoanBank');  

    //calculator
    Route::get('admin/sanctioncalculator', [AdminController::class, 'getSanctionCalculator'])->name('sanctioncalculator');
    Route::post('admin/add_sanction_calculator', [AdminController::class, 'postAddSanctionCalculator']);
    Route::get('admin/sanctioncalculatorhistory', [AdminController::class, 'getSanctionCalculatorHistory']);
    Route::get('admin/sanctioncalculatorhistoryAll', [AdminController::class, 'getAllSanctionCalculatorHistory']);
    Route::post('admin/add_sanction_calculator', [AdminController::class, 'postAddSanctionCalculator']);
    Route::get('admin/sanctioncalculator/{id}', [AdminController::class, 'getEditSanctionCalculator']);
    Route::post('admin/sanctioncalculator/{id}', [AdminController::class, 'postEditSanctionCalculator']);
    
    //MLM
    Route::get('admin/mlm', [MlmController::class, 'mlmView'])->name('mlmView');  
    Route::post('addMember', [MlmController::class, 'addMember'])->name('addMember');

    //commission
    Route::get('admin/allCommission', [CommissionController::class, 'allCommission'])->name('allCommission');
    Route::post('commission/insertCommission',[CommissionController::class,'insertCommission'])->name('insertCommission');
    Route::get('/editCommission/{com_id}', [CommissionController::class, 'editCommission'])->name('editCommission');
    Route::post('/updateCommission',[CommissionController::class,'updateCommission'])->name('updateCommission');
    Route::post('/deleteCommission',[CommissionController::class,'deleteCommission'])->name('deleteCommission');

    //eligibilityCriteria
    Route::get('/eligibilityCriteria',[EligibilityCriteriaController::class,'eligibilityCriteria'])->name('eligibilityCriteria');
    Route::get('/eligiblityDetails/{loan_id}', [EligibilityCriteriaController::class, 'eligiblityDetails'])->name('eligiblityDetails');
    Route::post('/calculate-eligibilityself', [EligibilityCriteriaController::class, 'calculateEligibility'])->name('calculate.eligibility');
    Route::post('/calculate-eligibilitysalaried', [EligibilityCriteriaController::class, 'calculateEligibilitysalaried'])->name('calculate.eligibility.salaried');

    //standalone
    Route::post('/calculate-eligibility-standalone', [EligibilityCriteriaController::class, 'calculateStandaloneEligibility'])->name('calculateEligibilitystandalone');
    Route::get('/standalone-self', [EligibilityCriteriaController::class, 'showStandaloneForm'])
    ->name('standalone.self');

    Route::get('/standalone-salaried', [EligibilityCriteriaController::class, 'showStandaloneSalariedForm'])
    ->name('standalone.salaried');  
});

//admin user profile


//customer register
Route::get('/register', function () {
    return view('register'); // Make sure this points to your registration view
})->name('registerPage');

Route::post('/register', [UsersController::class, 'registerUser'])->name('registerUser');





//agent
Route::middleware('isAgent')->group(function () {
    Route::get('agent/agentDashboard', action: [AgentController::class, 'agentDashboard'])->name('agentDashboard');
    Route::get('agent/allAgents', [AgentController::class, 'allAgents'])->name('allAgents');
    // Route::post('agent/insertAgent', action: [AgentController::class, 'insertAgent'])->name('insertAgent');
    Route::post('agent/insertAgent', [AgentController::class, 'insertAgent'])->name('insertAgent');

    

    Route::get('/editAgent/{user_id}', [AgentController::class, 'editAgent'])->name('editAgent');
    Route::post('/updateAgent', [AgentController::class, 'updateAgent'])->name('updateAgent');
    Route::post('/deleteAgent', [AgentController::class, 'deleteAgent'])->name('deleteAgent');
    Route::get('agent/assigned-loans', [LoanApplicationController::class, 'assignedLoans'])->name('agent.assignedLoans');
    Route::get('loan/details/{id}', [LoanApplicationController::class, 'loanShow'])->name('loan.details');
    Route::post('agent/accept-loan', [LoanApplicationController::class, 'acceptLoan'])->name('agent.acceptLoan');
    Route::post('agent/reject-loan', [LoanApplicationController::class, 'rejectLoan'])->name('agent.rejectLoan');
    Route::get('agent/referral_earnings', [ReferralController::class, 'referral_earnings'])->name('referral_earnings');
    Route::get('agent/walletbalance', [ReferralController::class, 'walletbalance'])->name('walletbalance');
    

});

// Admin routes
Route::get('/admin/withdrawal-requests', [ReferralController::class, 'viewWithdrawalRequests'])->name('admin.withdrawal.requests');
Route::post('/user/withdraw-request', [ReferralController::class, 'requestWithdrawal'])->name('user.withdraw.request');

    // Route to approve a withdrawal request
Route::post('/admin/withdrawal-approve/{id}', [ReferralController::class, 'approveWithdrawal'])->name('admin.withdrawal.approve');
Route::get('/admin/transactions', [ReferralController::class, 'showAllTransactions'])->name('admin.transactions');
Route::get('/agent/transactions', [ReferralController::class, 'showTransactionHistory'])->name('agent.transactions');
Route::get('/admin/transactions/{transactionId}/history', [ReferralController::class, 'showTransactionHistoryadmin']);

Route::get('user/transactions', [ReferralController::class, 'showAllTransactionsUser'])->name('transactions.list');

//channel partner
Route::middleware('isPartner')->group(function () {
    Route::get('partner/partnerDashboard', [PartnerController::class, 'partnerDashboard'])->name('partnerDashboard');
    Route::get('partner/allPartners', [PartnerController::class, 'allPartners'])->name('allPartners');
    Route::post('partner/insertPartner',[PartnerController::class,'insertPartner'])->name('insertPartner');
    Route::get('/editPartner/{user_id}', [PartnerController::class, 'editPartner'])->name('editPartner');
    Route::post('/updatePartner', [PartnerController::class, 'updatePartner'])->name('updatePartner');
    Route::post('/deletePartner', [PartnerController::class, 'deletePartner'])->name('deletePartner');

    //property
    Route::get('partner/pendingProperties', [PropertyController::class, 'pendingProperties'])->name('pendingProperties');
    Route::get('partner/addProperty', [PropertyController::class, 'addProperty'])->name('addProperty');
    Route::post('partner/insertProperty',[PropertyController::class,'insertProperty'])->name('insertProperty');
    Route::get('partner/allProperties', [PropertyController::class, 'allProperties'])->name('allProperties');
    Route::get('/viewDetails/{property_id}', [PropertyController::class, 'viewDetails'])->name('viewDetails');
    Route::get('/editProperty/{property_id}', [PropertyController::class, 'editProperty'])->name('editProperty');
    Route::post('/updatePropertie', [PropertyController::class, 'updatePropertie'])->name('updatePropertie');
    Route::post('/deletePropertie', [PropertyController::class, 'deletePropertie'])->name('deletePropertie');
    Route::post('/activate-property', [PropertyController::class, 'activate'])->name('activate.property');

    //profile
    Route::get('/partner/profile', [ProfileController::class, 'showPartnerProfile'])->name('partner.profile');
    Route::post('/partner/profile/update', [ProfileController::class, 'updatePartnerProfile'])->name('partner.updateProfile');

});




//Frontend propertie 
Route::get('properties', [FrontendController::class, 'properties'])->name('properties');




Route::middleware('isAdmin')->group(function () {
    Route::get('admin/profile/edit', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('admin/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
});



//channel partner
//Route::middleware('isBroker')->group(function () {
    Route::get('broker/allLoansApplications', [BrokerController::class, 'allLoansApplications'])->name('allLoansApplications');
    Route::get('broker/addLoan', [BrokerController::class, 'addLoan'])->name('addLoan');
    Route::post('broker/insertLoan',[BrokerController::class,'insertLoan'])->name('insertLoan');
    Route::get('/editBrokerLoan/{loan_id}', [BrokerController::class, 'editBrokerLoan'])->name('editBrokerLoan');
    Route::post('/updateLoanApplication', [BrokerController::class, 'updateLoanApplication'])->name('updateLoanApplication');
    Route::post('/deleteLoanApplication', [BrokerController::class, 'deleteLoanApplication'])->name('deleteLoanApplication');
//});

// Cibil Score Api
Route::get('credit-score', [CibilController::class, 'fetchCreditScore']);

// Route::get('/mis', [MISController::class, 'index'])->name('mis.index');
// Route::post('/mis/store', [MISController::class, 'store'])->name('mis.store');
// Route::post('/mis/delete', [MISController::class, 'destroy'])->name('mis.delete');
// Route::get('/mis/edit/{id}', [MISController::class, 'edit'])->name('mis.edit');
// Route::put('/mis/update/{id}', [MISController::class, 'update'])->name('mis.update');

Route::group([], function () {
    Route::get('/mis', [MisController::class, 'index'])->name('mis.index');
    Route::post('/mis/store', [MisController::class, 'store'])->name('mis.store');
    Route::post('/mis/delete', [MisController::class, 'destroy'])->name('mis.delete');
    Route::get('/mis/edit/{id}', [MisController::class, 'edit'])->name('mis.edit');
    Route::put('/mis/update/{id}', [MisController::class, 'update'])->name('mis.update');
    Route::get('mis/export/excel', [MisController::class, 'exportExcel'])->name('mis.exportExcel');
    Route::get('mis/export/pdf', [MisController::class, 'exportPDF'])->name('mis.exportPDF');
});



// Mail
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index'); // Inbox
Route::get('/messages/compose', [MessageController::class, 'compose'])->name('messages.compose'); // Compose Mail
Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send'); // Send Mail
Route::get('/messages/sent', [MessageController::class, 'sentMessages'])->name('messages.sent'); // Sent Messages
Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');

//Lead management
Route::resource('/admin/leads', LeadController::class);

//property taker
Route::get('admin/property-takers/create', [PropertyTakerController::class, 'create'])->name('property_takers.create');
Route::post('admin/property-takers/store', [PropertyTakerController::class, 'store'])->name('property_takers.store');
Route::get('admin/property-takers', [PropertyTakerController::class, 'index'])->name('property_takers.index');
Route::get('admin/property-takers/{id}/edit', [PropertyTakerController::class, 'edit'])->name('property_takers.edit');
Route::put('admin/property-takers/{id}', [PropertyTakerController::class, 'update'])->name('property_takers.update');
Route::get('admin/property-takers/{id}', [PropertyTakerController::class, 'show'])->name('property_takers.view');
Route::delete('admin/property-takers/{id}', [PropertyTakerController::class, 'destroy'])
    ->name('property_takers.destroy');

//  P & L
Route::middleware('isAdmin')->group(function () {

    // List
    Route::get(
        'admin/estimated-file',
        [EstimatedFileController::class, 'index']
    )->name('estimatedFile.index');

    // Create
    Route::get(
        'admin/estimated-file/create',
        [EstimatedFileController::class, 'create']
    )->name('estimatedFile.create');

    // Store
    Route::post(
        'admin/estimated-file/store',
        [EstimatedFileController::class, 'store']
    )->name('estimatedFile.store');

    // Edit
    Route::get(
        'admin/estimated-file/{id}/edit',
        [EstimatedFileController::class, 'edit']
    )->name('estimatedFile.edit');
    // View
    Route::get('/estimated-file/{id}', [EstimatedFileController::class, 'show'])
    ->name('estimatedFile.show');


    // Update
    Route::post(
        'admin/estimated-file/{id}/update',
        [EstimatedFileController::class, 'update']
    )->name('estimatedFile.update');

    // Delete
    Route::delete(
        'admin/estimated-file/{id}',
        [EstimatedFileController::class, 'destroy']
    )->name('estimatedFile.delete');
     Route::get(
        'admin/monthly-pl',
        [EstimatedFileController::class, 'indexPL']
    )->name('monthlyPL.index');

    Route::get(
        'admin/monthly-pl/gross-revenue',
        [EstimatedFileController::class, 'getGrossRevenue']
    )->name('monthlyPL.grossRevenue');


});
Route::middleware('isAdmin')->group(function () {

    Route::post(
        'admin/monthly-pl/save',
        [MonthlyPLController::class, 'store']
    )->name('monthlyPL.store');

    Route::get(
        'admin/monthly-pl/export-excel/{id}',
        [MonthlyPLController::class, 'exportExcel']
    )->name('monthlyPL.exportExcel');

    Route::get(
        'admin/monthly-pl/export-pdf/{id}',
        [MonthlyPLController::class, 'exportPdf']
    )->name('monthlyPL.exportPdf');
});
Route::middleware('isAdmin')->group(function () {

    Route::get(
        'admin/monthly-pl-list',
        [MonthlyPLController::class, 'list']
    )->name('monthlyPL.list');

    Route::get(
        'admin/monthly-pl/export-formatted/{id}',
        [MonthlyPLController::class, 'exportFormattedExcel']
    )->name('monthlyPL.exportFormatted');
});Route::get('/monthly-pl/{id}', [MonthlyPLController::class, 'show'])
     ->name('monthlyPL.show');

Route::get(
    'admin/monthly-pl/export-with-estimated/{id}',
    [MonthlyPLController::class, 'exportWithEstimated']
)->name('monthlyPL.exportWithEstimated');

Route::middleware(['auth'])->group(function(){

    Route::get('/tickets', [TicketController::class,'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class,'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class,'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class,'show'])->name('tickets.show');

    Route::post('/tickets/{id}/message', [TicketMessageController::class,'sendMessage'])->name('tickets.message');
    Route::get('/admin/user/{userId}/loans', [TicketController::class,'getUserLoans']);
    Route::get('/admin/loan/{loanId}/agent', [TicketController::class,'getLoanAgent']);
    Route::post('/tickets/{id}/close', [TicketController::class,'close'])
    ->name('tickets.close');
    Route::get('/agent/customers', [TicketController::class,'agentCustomers']);
    Route::get('/agent/user/{id}/loans', [TicketController::class,'agentUserLoans']);
});

// property booking
Route::middleware(['auth'])->group(function () {

    /* =======================
       CUSTOMER ROUTES
    ======================== */
    Route::get(
        'customer/property/{id}/book',
        [CustomerBookingController::class, 'showBookingForm']
    )->name('customer.property.book.form');

    Route::post(
        'customer/property/book/submit',
        [CustomerBookingController::class, 'submitBookingForm']
    )->name('customer.property.book.submit');

    Route::get('customer/properties',
        [CustomerBookingController::class, 'showProperties']
    )->name('customer.properties');

    Route::post('customer/book-property',
        [CustomerBookingController::class, 'store']
    )->name('customer.book.property');

    Route::post('booking/confirm/{id}',
        [CustomerBookingController::class, 'customerConfirm']
    )->name('customer.booking.confirm');
Route::get('customer/bookings',
    [CustomerBookingController::class, 'customerBookings']
)->name('customer.bookings');
    /* =======================
       ADMIN ROUTES
    ======================== */
    Route::get('admin/property-bookings/{id}',
    [CustomerBookingController::class, 'adminView']
)->name('admin.property.booking.view');

    Route::get('admin/property-bookings',
        [CustomerBookingController::class, 'adminIndex']
    )->name('admin.property.bookings');
Route::get('customer/booking/{id}/confirm',
    [CustomerBookingController::class, 'showConfirmOffer']
)->name('customer.booking.show.confirm');

    Route::post('admin/booking/review/{id}',
        [CustomerBookingController::class, 'adminReview']
    );
    Route::post('/admin/check-referral', [CustomerBookingController::class, 'checkReferral'])
    ->name('admin.check.referral');

    Route::post('admin/booking/offer/{id}',
        [CustomerBookingController::class, 'adminOffer']
    );
    Route::get('admin/booking/edit/{id}', [CustomerBookingController::class, 'adminEdit'])
    ->name('admin.booking.edit');

Route::post('admin/booking/update/{id}', [CustomerBookingController::class, 'adminUpdate'])
    ->name('admin.booking.update');

    Route::post('admin/booking/final/{id}',
        [CustomerBookingController::class, 'adminFinalSubmit']
    );

    // cp routes
    Route::post('/assign-cp', [CustomerBookingController::class, 'assignCp'])
    ->name('admin.assign.cp');
    Route::post('/cp/accept', [CustomerBookingController::class, 'cpAccept'])->name('cp.accept');
Route::post('/cp/reject', [CustomerBookingController::class, 'cpReject'])->name('cp.reject');
// Route::get('/agent/assigned-leads', [VisitEnquiryController::class, 'agentLeads'])
//     ->middleware('auth')
//     ->name('agent.leads');
Route::get('/partner/assigned-leads', [VisitEnquiryController::class, 'partnerLeads'])
    ->middleware('auth')
    ->name('partner.leads');
    Route::get('/partner/pending-leads', 
    [VisitEnquiryController::class, 'partnerPendingLeads'])
    ->middleware('auth')
    ->name('partner.pending.leads');
});


    
Route::middleware(['isPartner'])->group(function () {

    Route::get('admin/price-range', [PriceRangeController::class, 'index'])
        ->name('admin.price.range');

    Route::get('admin/price-range/create', [PriceRangeController::class, 'create'])
        ->name('admin.price.range.create');

    Route::post('admin/price-range/store', [PriceRangeController::class, 'store'])
        ->name('admin.price.range.store');

    Route::get('admin/price-range/edit/{id}', [PriceRangeController::class, 'edit'])
        ->name('admin.price.range.edit');

    Route::post('admin/price-range/update/{id}', [PriceRangeController::class, 'update'])
        ->name('admin.price.range.update');

    Route::get('admin/price-range/delete/{id}', [PriceRangeController::class, 'destroy'])
        ->name('admin.price.range.delete');

});
Route::prefix('admin')->group(function () {
    Route::resource('payout-configs', DsaPayoutConfigController::class);
});
Route::post('admin/payouts/{id}/release', [DsaPayoutController::class, 'release'])
    ->name('payouts.release');
    Route::get('admin/payouts', [DsaPayoutController::class, 'index'])->name('payouts.index');

   