<?php

namespace App\Http;

use App\Http\Middleware\ApprovalMiddleware;
use App\Http\Middleware\CheckAdministrator;
use App\Http\Middleware\CheckCreateUser;
use App\Http\Middleware\CheckDesignation;
use App\Http\Middleware\CheckEditUser;
use App\Http\Middleware\CheckEmployee;
use App\Http\Middleware\CheckFactoryDepartment;
use App\Http\Middleware\CheckFactoryIT;
use App\Http\Middleware\CheckImageAccess;
use App\Http\Middleware\CheckIssue;
use App\Http\Middleware\CheckLocation;
use App\Http\Middleware\CheckManagement;
use App\Http\Middleware\CheckReceive;
use App\Http\Middleware\CheckReport;
use App\Http\Middleware\CheckSettings;
use App\Http\Middleware\CheckResetPassword;
use App\Http\Middleware\CheckRestoreUser;
use App\Http\Middleware\CheckTopManagement;
use App\Http\Middleware\CheckTransfer;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\ApprovalMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'administrator' => CheckAdministrator::class,
        'createuser' => CheckCreateUser::class,
        'restoreuser' => CheckRestoreUser::class,
        'updateuser' => CheckEditUser::class,
        'resetpassword' => CheckResetPassword::class,
        'settings' => CheckSettings::class,
        'factory_department' => CheckFactoryDepartment::class,
        'factory_it' =>CheckFactoryIT::class,
        'designation' => CheckDesignation::class,
        'employee' => CheckEmployee::class,
        'receive' => CheckReceive::class,
        'issue' => CheckIssue::class,
        'transfer' => CheckTransfer::class,
        'report' => CheckReport::class,
        'top-management' => CheckTopManagement::class,
        'management' => CheckManagement::class,
        'location' => CheckLocation::class,
        'image_access' =>CheckImageAccess::class,
    ];
}
