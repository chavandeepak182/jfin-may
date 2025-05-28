<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\MisController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PropertyTakerController;
use Illuminate\Support\Facades\Route;
use App\Exports\EligibilityExport;
use Maatwebsite\Excel\Facades\Excel;

require __DIR__.'/auth.php';




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


//frontend routes
Route::get('/', function () {
    return view('frontend.index');
});

Route::get('contact', [FrontendController::class, 'ContactView']);
Route::get('test', [FrontendController::class, 'TestView']);
Route::get('registration', [FrontendController::class, 'RegisterView']);
Route::get('services', [FrontendController::class, 'ServicesView']);
Route::get('about', [FrontendController::class, 'AboutView']);
Route::get('privacy-policy', [FrontendController::class, 'PrivacyView']);
Route::get('terms-and-conditions', [FrontendController::class, 'TermCondView']);
Route::get('myprofile', [FrontendController::class, 'ProfileView']);
Route::get('emi-calculator', [FrontendController::class, 'CalculatorView']);
Route::get('properties', [FrontendController::class, 'properties'])->name('properties');
Route::get('property-details/{property_id}', [FrontendController::class, 'PropDetailsView']);
Route::get('referral-program', [FrontendController::class, 'ReferralsView']);
Route::get('home-loan', [FrontendController::class, 'HomeLoanView']);
Route::get('loan-against-property', [FrontendController::class, 'LAPLoanView']);
Route::get('project-loan', [FrontendController::class, 'ProjectLoanView']);
Route::get('overdraft-facility', [FrontendController::class, 'OverdraftLoanView']);
Route::get('lease-rental-discounting', [FrontendController::class, 'LRDLoanView']);
Route::get('msme-loan', [FrontendController::class, 'MSMELoanView']);

Route::post('search_properties', [FrontendController::class, 'search_properties'])->name('search_properties');


// Loan Application Routes
Route::get('professional-detail', [FrontendController::class, 'ProfessionalDetailView']);


//user routes
Route::get('login', [AdminController::class, 'loginView'])->name('login');
Route::post('userLogin', [FrontendController::class, 'userLogin'])->name('userLogin');

Route::get('verify-otp', [AdminController::class, 'verifyOtp'])->name('verify-otp');

Route::post('submit-otp', [AdminController::class, 'postVerifyOtp'])->name('submit-otp');


Route::get('logout', [FrontendController::class, 'logout'])->name('logout');
Route::get('forgot', [FrontendController::class, 'forgot'])->name('forgot');
Route::get('/activate', [FrontendController::class, 'activate'])->name('activate')->middleware('throttle:6,1');;

//reset password
Route::post('reset_password_link', [FrontendController::class, 'reset_password_link'])->name('reset_password_link');
Route::get('reset_password/{auth_id}', [FrontendController::class, 'reset_password'])->name('reset_password');
Route::post('update_password', [FrontendController::class, 'update_password'])->name('update_password');


// notification routes
Route::get('/notifications', [UsersController::class, 'showNotifications'])->name('notifications.index');
Route::post('/notifications/read/{id}', [UsersController::class, 'markAsRead']);
Route::get('/notifications', [UsersController::class, 'getNotifications']);
Route::get('/cities/{state_id}', [LoanApplicationController::class, 'getCities'])->name('getCities');


//loan
Route::get('/applyNow', [LoanApplicationController::class, 'applyNow'])->name('applyNow');
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
    Route::get('/myprofessional', [UsersController::class, 'myprofessional'])->name('loan.myprofessional');
    Route::get('/myeducation', [UsersController::class, 'myeducation'])->name('loan.myeducation');
    Route::get('/mydocuments', [UsersController::class, 'mydocuments'])->name('loan.mydocuments');


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

});


Route::get('admin/loan-application', [LoanApplicationController::class, 'showForm'])->name('loan.form');


//loan admin
Route::get('admin/loans', [LoanApplicationController::class, 'index'])->name('loans.index');
Route::post('admin/insertLoan', [LoanApplicationController::class, 'store'])->name('insertLoan');
Route::post('admin/deleteLoan', [LoanApplicationController::class, 'destroy'])->name('deleteLoan');
Route::get('admin/editLoan/{id}', [LoanApplicationController::class, 'edit'])->name('editLoan');
Route::post('admin/updateLoan', [LoanApplicationController::class, 'update'])->name('updateLoan');
Route::get('admin/loan/{id}', [LoanApplicationController::class, 'view'])->name('loan.view');
Route::get('admin/inprocess-loans', [LoanApplicationController::class, 'inprocess'])->name('inprocess.loans');
Route::get('admin/disbursed-loans', [LoanApplicationController::class, 'disbursed'])->name('disbursed.loans');
Route::get('admin/pending-loans', [LoanApplicationController::class, 'pendingLoans'])->name('pendingLoans');
Route::get('admin/approved-loans', [LoanApplicationController::class, 'approved'])->name('approvedLoans');
Route::get('admin/rejected-loans', [LoanApplicationController::class, 'rejected'])->name('rejectedLoans');

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
Route::post('enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');
//register 
Route::post('register', [UsersController::class, 'register'])->name('register');


Route::middleware('isAdmin')->group(function () {
Route::post('admin/insertUser',[UsersController::class,'insertUser'])->name('insertUser');
    Route::get('/editUser/{user_id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('/updateUser', [UsersController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser', [UsersController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/updateProfile', [UsersController::class, 'updateProfile'])->name('updateProfile');
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/admindashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('admin/addUser', [UsersController::class, 'addUser'])->name('addUser');
    Route::get('admin/allUsers', [UsersController::class, 'allUsers'])->name('allUsers');  
    Route::post('/update-user-status', [UsersController::class, 'updateUserStatus'])->name('updateUserStatus');
    Route::post('admin/assignAgent', [LoanApplicationController::class, 'assignAgent'])->name('assignAgent');

    //activity list
    Route::get('admin/activities', [AdminController::class, 'activities'])->name('activities');  
  
    
    //referral
    Route::get('admin/referral_earnings', [ReferralController::class, 'referral_earnings'])->name('referral_earnings');
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
});

//admin user profile

Route::get('admin/profile/edit', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
Route::post('admin/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('admin/profile', [ProfileController::class, 'showProfile'])->name('admin.profile');
//customer register
Route::get('/register', function () {
    return view('register'); // Make sure this points to your registration view
})->name('registerPage');

Route::post('/register', [UsersController::class, 'registerUser'])->name('registerUser');





//agent
Route::middleware('isAgent')->group(function () {
    Route::get('agent/agentDashboard', [AgentController::class, 'agentDashboard'])->name('agentDashboard');
    Route::get('agent/allAgents', [AgentController::class, 'allAgents'])->name('allAgents');
    Route::post('agent/insertAgent',[AgentController::class,'insertAgent'])->name('insertAgent');
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
    Route::post('/activate', [PropertyController::class, 'activate'])->name('activate');

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

Route::get('/mis', [MISController::class, 'index'])->name('mis.index');
Route::post('/mis/store', [MISController::class, 'store'])->name('mis.store');
Route::post('/mis/delete', [MISController::class, 'destroy'])->name('mis.delete');
Route::get('/mis/edit/{id}', [MISController::class, 'edit'])->name('mis.edit');
Route::put('/mis/update/{id}', [MISController::class, 'update'])->name('mis.update');
Route::get('mis/export/excel', [MisController::class, 'exportExcel'])->name('mis.exportExcel');
Route::get('mis/export/pdf', [MisController::class, 'exportPDF'])->name('mis.exportPDF');
    

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