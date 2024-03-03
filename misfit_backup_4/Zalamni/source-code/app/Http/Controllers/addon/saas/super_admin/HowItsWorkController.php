<?php

namespace App\Http\Controllers\addon\saas\super_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HowItsWorkRequest;
use App\Http\Services\addon\saas\HowItsWorkService;
use App\Models\HowItsWork;
use App\Traits\ResponseTrait;
use Exception;

class HowItsWorkController extends Controller
{
    use ResponseTrait;
    protected $howItsWork;
    public function __construct()
    {
        $this->howItsWork = new HowItsWorkService();
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = __('How Its Work Section');
        $data['showFrontendSectionList'] = 'show active';
        $data['activeFrontendList'] = 'active';
        $data['howItsWorkActiveClass'] = 'active-color-one';
        if ($request->ajax()) {
            return $this->howItsWork->list();
        }
        return view('addon.saas.super_admin.frontend-setting.how-its-works.index', $data);
    }

    public function store(HowItsWorkRequest $request)
    {
        return $this->howItsWork->store($request);
    }

    public function delete($id)
    {
        return $this->howItsWork->delete($id);
    }

    public function edit($id)
    {
        $data['pageTitle'] = __('How Its Work Section');
        try {
            $data['howItWork'] = HowItsWork::find($id);
            if (is_null($data['howItWork'])) {
                return $this->error([], getMessage(SOMETHING_WENT_WRONG));
            }
        } catch (Exception $exception) {
            return $this->error([], getMessage(SOMETHING_WENT_WRONG));
        }
        return view('addon.saas.super_admin.frontend-setting.how-its-works.edit-form', $data);;
    }
}
