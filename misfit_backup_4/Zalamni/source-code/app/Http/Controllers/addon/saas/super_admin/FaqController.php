<?php

namespace App\Http\Controllers\addon\saas\super_admin;


use App\Http\Services\addon\saas\FaqService;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    use ResponseTrait;
    protected $faq;
    public function __construct()
    {
        $this->faq = new FaqService();
    }

    public function index(Request $request){
        $data['pageTitle'] = __('Faq Section');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['faqActiveClass'] = 'active-color-one';
        if($request->ajax()){
            return $this->faq->list();
        }
        return view('addon.saas.super_admin.frontend-setting.faq.index', $data);
    }

    public function store(FaqRequest $request){
        return $this->faq->faqStore($request);
    }

    public function delete($id){
        return $this->faq->faqDelete($id);
    }

    public function edit($id)
    {
        $data['pageTitle'] = __('Faq Section');

        try {
            $data['faq'] = Faq::find($id);
            if (is_null($data['faq'])) {
                return $this->error([], getMessage(SOMETHING_WENT_WRONG));
            }
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
        return view('addon.saas.super_admin.frontend-setting.faq.edit-form', $data);;
    }


}
