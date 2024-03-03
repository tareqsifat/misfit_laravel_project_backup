<div class="email__sidebar bg-style">
    <div class="sidebar__item">
        <ul class="d-flex flex-column rg-15 sidebar__mail__nav">
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$sectionSettingsActiveClass }}">{{__('Frontend Setting')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.section.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$subSectionSettingsActiveClass }}">{{__('Section Setting')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.how-its-works.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$howItsWorkActiveClass }}">{{__('How It Work')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.features.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$featuresActiveClass }}">{{__('Features')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.core-page.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$bestFeaturesActiveClass }}">{{__('Core Pages')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.faq.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$faqActiveClass }}">{{__('Faq')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('saas.super_admin.frontend-setting.testimonial.index') }}"
                   class="align-items-center flex list-item list-item">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$subTestimonialActiveClass }}">{{__('Testimonial')}}</span>
                </a>
            </li>

            <li>
                <a class="align-items-center flex list-item list-item"
                   href="{{ route('saas.super_admin.frontend-setting.privacy-policy') }}">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$privacyPolicyActiveClass }}">{{ __('Privacy Policy') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item list-item"
                   href="{{ route('saas.super_admin.frontend-setting.cookie-policy') }}">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$cookiePolicyActiveClass }}">{{ __('Cookie Policy') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item list-item"
                   href="{{ route('saas.super_admin.frontend-setting.terms-condition') }}">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$termsConditionActiveClass }}">{{ __('Terms And Condition') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item list-item"
                   href="{{ route('saas.super_admin.frontend-setting.refund-policy') }}">
                    <span class="fa fa-gear fs-14 text-707070"></span>
                    <span class="font-bold fs-14 hover-color-one text-1b1c17 {{ @$refundPolicyActiveClass }}">{{ __('Refund Policy') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
