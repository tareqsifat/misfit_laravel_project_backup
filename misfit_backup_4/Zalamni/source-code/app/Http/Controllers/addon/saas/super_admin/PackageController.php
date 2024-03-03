<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PackageRequest;
use App\Http\Services\addon\saas\PackageService;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use ResponseTrait;
    public $packageService;

    public function __construct()
    {
        $this->packageService = new PackageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->packageService->getAllData($request);
        } else {
            $data['title'] = __('All Packages');
            $data['activeSubscription'] = 'active';
            return view('addon.saas.super_admin.packages.index', $data);
        }
    }

    public function store(PackageRequest $request)
    {
        return $this->packageService->store($request);
    }

    public function edit($id)
    {
        $data = $this->packageService->getInfo($id);
        $data['package'] = $data;
        return view('addon.saas.super_admin.packages.edit_form', $data);
    }

    public function destroy($id)
    {
        return $this->packageService->destroy($id);
    }

    public function userPackage(Request $request)
    {
        if ($request->ajax()) {
            return $this->packageService->getUserPackagesData($request);
        } else {
            $data['title'] = __('User Packages');
            $data['activePackageUser'] = 'active';
            $data['users'] = User::where('role', USER_ROLE_ADMIN)->get();
            $data['packages'] = $this->packageService->getAll();
            return view('addon.saas.super_admin.packages.user', $data);
        }
    }

    public function assignPackage(Request $request)
    {
        return $this->packageService->assignPackage($request);
    }
}
