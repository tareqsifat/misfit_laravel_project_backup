<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\CustomerRequest;
use App\Http\Services\addon\saas\CustomerService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    use ResponseTrait;

    public $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            return $this->customerService->customerList();
        }
        $data['pageTitle'] = __('Customer List');
        $data['showCustomerList'] = 'active';
        return view('addon.saas.super_admin.customer.index', $data);
    }

    public function delete($id)
    {
        return $this->customerService->deleteById($id);
    }

    public function edit(Request $request)
    {
        $data['pageTitle'] = __('Customer List');
        $data['customer'] = $this->customerService->getById($request->id);
        return view('addon.saas.super_admin.customer.edit-form', $data);
    }

    public function update($id, CustomerRequest $request)
    {
        return $this->customerService->update($id, $request);
    }

    public function details(Request $request)
    {
        $data['showCustomerList'] = 'active';
        $data['pageTitle'] = __('Customer Details');
        $data['customer'] = $this->customerService->getById($request->id);
        $data['domainInformation'] = $this->customerService->domainInformation($request->id);
        if ($request->ajax()) {
            return $this->customerService->customerTransaction($request->id);
        }

        return view('addon.saas.super_admin.customer.customer_details', $data);
    }


}
