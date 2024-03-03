<?php

namespace App\Http\Controllers\addon\saas\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomDomainRequestRequest;
use App\Http\Services\addon\saas\CustomDomainRequestService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class CustomDomainRequestController extends Controller
{
    use ResponseTrait;
    public $customDomainService;

    public function __construct()
    {
        $this->customDomainService = new CustomDomainRequestService;
    }

    public function index(Request $request)
    {
        if($request->wantsJson()){
            return $this->customDomainService->list();
        }

        $data['activeCustomDomainRequest'] = 'active';
        $data['title'] = __('Domain Setup');
        $data['currentDomain'] = Domain::where('tenant_id', getTenantId())->first()?->domain;
        return view('addon.saas.admin.custom_domain.index', $data);
    }

    public function info($id)
    {
        $data['currentDomain'] = Domain::where('tenant_id', getTenantId())->first()?->domain;
        $data['customDomain'] = $this->customDomainService->getById($id);
        return view('addon.saas.admin.custom_domain.edit-form', $data);
    }

    public function store(CustomDomainRequestRequest $request)
    {
        return $this->customDomainService->store($request);
    }

    public function update(CustomDomainRequestRequest $request, $id)
    {
        return $this->customDomainService->update($request, $id);
    }

    public function delete($id)
    {
        return $this->customDomainService->deleteById($id);
    }
}
