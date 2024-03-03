<?php

namespace App\Http\Controllers\addon\saas\frontend;

use App\Http\Services\addon\saas\FrontendService;
use App\Http\Services\addon\saas\PackageService;
use App\Http\Services\addon\saas\SubscriptionService;
use Illuminate\Routing\Controller as BaseController;

class FrontendController extends BaseController
{
    public function index(){
        $packageService = new PackageService();
        $frontendService = new FrontendService();
        $frontendSection = $frontendService->FrontendSection();

        $data['title'] = __('Website');
        $data['packages'] = $packageService->getActiveAll();
        $data['allFaq'] = $frontendService->faq();
        $data['allTestimonial'] = $frontendService->testimonial();
        $data['corePages'] = $frontendService->corePages();
        $data['features'] = $frontendService->features();
        $data['howItsWork'] = $frontendService->howItsWork();
        $subscriptionService = new SubscriptionService;
        $data['currentPackage'] = $subscriptionService->getCurrentPlan();

        $data['section'] = [
            'hero_banner' => $frontendSection->where('slug', 'hero_banner')->first(),
            'core_features' => $frontendSection->where('slug', 'core_features')->first(),
            'how_its_work_area' => $frontendSection->where('slug', 'how_its_work_area')->first(),
            'pricing_plan' => $frontendSection->where('slug', 'pricing_plan')->first(),
            'core_pages' => $frontendSection->where('slug', 'core_pages')->first(),
            'testimonials_area' => $frontendSection->where('slug', 'testimonials_area')->first(),
            'faqs_area' => $frontendSection->where('slug', 'faqs_area')->first(),
        ];

        return view('addon.saas.frontend.index', $data);
    }

    public function contactUs(){
        return view('addon.saas.frontend.contact-us');
    }

    public function page($slug)
    {
        $data['pageTitle'] = __(getOption($slug.'_title'));
        $data['description'] = getOption($slug.'_description');
        return view('addon.saas.frontend.page', $data);
    }
}
