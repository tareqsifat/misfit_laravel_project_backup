<?php

use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware([
    'web',
    \App\Http\Middleware\Tenant\InitializeTenancyByDomainCustomisedMiddleware::class,
    PreventAccessFromCentralDomains::class,
    'auth:admin',
    'tenant_admin_glvar',
    'package_expire',
    'tenantAdminPanelMailVerify',
    'setlang'
])->prefix('admin-home')->group(function () {
    /*----------------------------------------------------------------------------------------------------------------------------
    | BACKEND COUNTRY MANAGE AREA
    |----------------------------------------------------------------------------------------------------------------------------*/
    // tenant.admin.state.by.country
    // Route::group(['as' => 'admin.'], function () {
        /*-----------------------------------
            COUNTRY ROUTES
        ------------------------------------*/
    
    // });
});

