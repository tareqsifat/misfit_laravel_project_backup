<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Http\Services\addon\saas\TestimonialSettingService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;


class TestimonialController extends Controller
{
    use ResponseTrait;

    public $testimonialService;

    public function __construct()
    {
        $this->testimonialService = new TestimonialSettingService();
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = __('Testimonial');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['subTestimonialActiveClass'] = 'active-color-one';
        if ($request->ajax()) {
            return $this->testimonialService->list();
        }
        return view('addon.saas.super_admin.frontend-setting.testimonial.index', $data);
    }

    public function store(TestimonialRequest $request)
    {
        return $this->testimonialService->store($request);
    }

    public function info($id)
    {
        $data['testimonial'] = $this->testimonialService->getById($id);
        return view('addon.saas.super_admin.frontend-setting.testimonial.edit-form', $data);
    }

    public function update(TestimonialRequest $request, $id)
    {
        return $this->testimonialService->update($id, $request);
    }

    public function delete(Request $request)
    {
        return $this->testimonialService->delete($request);
    }
}
