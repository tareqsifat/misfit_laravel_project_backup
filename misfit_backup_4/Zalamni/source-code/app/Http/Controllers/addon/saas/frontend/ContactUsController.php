<?php

namespace App\Http\Controllers\addon\saas\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Http\Services\ContactUsService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ResponseTrait;
    protected $contactUsService;

    public function __construct()
    {
        $this->contactUsService = new ContactUsService();
    }

    public function contactList(Request $request)
    {
        $data['title'] = __('Contact Us');
        $data['activeContactUs'] = 'active';

        if ($request->ajax()) {
            return $this->contactUsService->getAllData($request);
        }

        return view('addon.saas.super_admin.contact-us.index', $data);

    }

    public function store(ContactUsRequest $request)
    {
        return  $this->contactUsService->store($request);
    }

}
