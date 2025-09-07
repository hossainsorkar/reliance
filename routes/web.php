<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TerminalsController;
use App\Http\Controllers\ExpenseFieldsController;
use App\Http\Controllers\PartiesListController;
use App\Http\Controllers\AddPartyController;
use App\Http\Controllers\BillRegisterController;
use App\Http\Controllers\BillStatementController;
use App\Http\Controllers\BankListController;
use App\Http\Controllers\AccountsListController;
use App\Http\Controllers\ChartOfAccountsController;
use App\Http\Controllers\NewIncomeController;
use App\Http\Controllers\NewExpenseController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ProfitAndLossController;
use App\Http\Controllers\PartyController; 
use App\Http\Controllers\AllReportsController;
use App\Http\Controllers\EmployeeVoucherController;
use App\Http\Controllers\LogViewerController;
use App\Http\Controllers\JobController;   // ✅ add JobController

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('all');
        Route::get('/add', [AdminController::class, 'create'])->name('add');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/view', [AdminController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::post('/{id}/toggle-login', [AdminController::class, 'toggleLogin'])->name('toggle-login');
    });

    // Employee Routes
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('all');
        Route::get('add', [EmployeeController::class, 'create'])->name('add');
        Route::post('store', [EmployeeController::class, 'store'])->name('store');
        Route::get('{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('{id}', [EmployeeController::class, 'update'])->name('update');
        Route::post('{id}/toggle-login', [EmployeeController::class, 'toggleLogin'])->name('toggle-login');
        Route::get('{id}/view', [EmployeeController::class, 'show'])->name('show');

        // Branches
        Route::get('branches', [EmployeeController::class, 'branches'])->name('branches');
        Route::post('branches/store', [EmployeeController::class, 'storeBranch'])->name('branches.store');
        Route::post('branches/{id}/toggle', [EmployeeController::class, 'toggleBranch'])->name('branches.toggle');
        Route::put('branches/{id}/update', [EmployeeController::class, 'updateBranch'])->name('branches.update');
    });

    // Terminals Routes
    Route::prefix('terminals')->name('terminals.')->group(function () {
        Route::get('/', [TerminalsController::class, 'index'])->name('index');
        Route::get('/create', [TerminalsController::class, 'create'])->name('create');
        Route::post('/store', [TerminalsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TerminalsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [TerminalsController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [TerminalsController::class, 'destroy'])->name('destroy');
    });

    // Expense Fields Routes
    Route::prefix('expense-fields')->name('expense-fields.')->group(function () {
        Route::get('/', [ExpenseFieldsController::class, 'index'])->name('index');
        Route::get('/create', [ExpenseFieldsController::class, 'create'])->name('create');
        Route::post('/store', [ExpenseFieldsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ExpenseFieldsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ExpenseFieldsController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [ExpenseFieldsController::class, 'destroy'])->name('destroy');
    });

    // ✅ Parties Routes
    Route::resource('parties', PartyController::class);
    Route::patch('parties/{party}/toggle-status', [PartyController::class, 'toggleStatus'])->name('parties.toggleStatus');

    // ✅ Jobs Routes
    Route::resource('jobs', JobController::class);
    Route::patch('jobs/{job}/toggle', [JobController::class, 'toggleStatus'])->name('jobs.toggle');

    // Other Modules
    Route::resource('bill-register', BillRegisterController::class);
    Route::resource('bill-statement', BillStatementController::class);
    Route::resource('bank-list', BankListController::class);
    Route::resource('accounts-list', AccountsListController::class);
    Route::resource('chart-of-accounts', ChartOfAccountsController::class);
    Route::resource('new-income', NewIncomeController::class);
    Route::resource('new-expense', NewExpenseController::class);
    Route::resource('cash-book', CashBookController::class);
    Route::resource('commission', CommissionController::class);
    Route::resource('profit-and-loss', ProfitAndLossController::class);
    Route::resource('all-reports', AllReportsController::class);
    Route::resource('employee-voucher', EmployeeVoucherController::class);
    Route::resource('log-viewer', LogViewerController::class);
});

require __DIR__.'/auth.php';
