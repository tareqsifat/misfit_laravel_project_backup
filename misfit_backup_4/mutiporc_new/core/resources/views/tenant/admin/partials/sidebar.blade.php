<div class="sidebar">
    <div class="row-logo">
        <div class="logo">
            <a class="logoPrimary" href="{{ url('/admin/dashboard') }}"><img src="{{global_asset('assets/landlord/admin/images/logo.svg')}}"></a>
            <a class="logoIcon" href="{{ url('/admin/dashboard') }}"><img src="{{ global_asset('assets/landlord/admin/images/logo.svg') }}"></a>
        </div>
    </div>
    <div class="sidebar-nav">
        <ul class="main-category-menu">
            <li class="sidebar-list active">
                <a href="{{ route('tenant.admin.dashboard') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/dashboard.svg') }}">
                    </span>
                    <span class="menu-name">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/product.svg') }}">
                    </span>
                    <span class="menu-name">Product</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{ url('/admin/product/list') }}">All Products</a></li>
                    <li><a class="nav-link" href="{{ url('/admin/product/add-product') }}">Add New Product</a></li>
                </ul>
            </li>
            
            <li class="sidebar-list subNav has-submenu ">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/staff.svg') }}">
                    </span>
                    <span class="menu-name">Staff Role Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{ route('tenant.admin.all.user') }}">All Staff</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.new.user')}}">Add New Staff</a></li>
                    <li><a class="nav-link" href="{{ route('tenant.admin.all.admin.role') }}">All Staff Role</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu ">
            <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/users.svg') }}">
                    </span>
                    <span class="menu-name">User Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{ route('tenant.admin.all.user') }}">All Users</a></li>
                    <li><a class="nav-link" href="{{route('landlord.admin.tenant.new')}}">Add New</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/product.svg') }}">
                    </span>
                    <span class="menu-name">Product Order Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.product.order.manage.all')}}">All Order</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.order.success.page')}}">Success Order Page</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.order.cancel.page')}}">Cancel Order Page</a> </li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.order.settings')}}">Order setting</a> </li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
            <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/badge.svg') }}">
                    </span>
                    <span class="menu-name">Badge Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.badge.all')}}">Badge Manage</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/country.svg') }}">
                    </span>
                    <span class="menu-name">Country Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.state.all')}}">State Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.country.all')}}">Country Manage</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/tax.svg') }}">
                    </span>
                    <span class="menu-name">Tax Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.tax.country.all')}}">Country tax Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.tax.state.all')}}">State tax Manage</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/shipping.svg') }}">
                    </span>
                    <span class="menu-name">Shipping Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.shipping.zone.all')}}">Shipping Zone</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.shipping.method.all')}}">Shipping Method</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
            <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/percent.svg') }}">
                    </span>
                    <span class="menu-name">Coupon Manage</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.product.coupon.all')}}">All Coupon</a></li>                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/attritube.svg') }}">
                    </span>
                    <span class="menu-name">Attribute</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.product.category.all')}}">Category Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.subcategory.all')}}">Subcategory Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.child-category.all')}}">Child Category Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.tag.all')}}">Tags Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.units.all')}}">Unit Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.colors.all')}}">Color Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.sizes.all')}}">Size Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.brand.manage.all')}}">Product Brand Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.product.delivery.option.all')}}">Delivery option Manage</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.products.attributes.all')}}">Product Attribute</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/event.svg') }}">
                    </span>
                    <span class="menu-name">Events</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.event')}}">All Event</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.event.new')}}">Add Event</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.event.category')}}">Category</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.event.payment.logs')}}">All Payment Logs</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.event.payment.logs.report')}}">Payment Logs Request</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.event.settings')}}">Setting</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/inventory.svg') }}">
                    </span>
                    <span class="menu-name">Inventory</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.product.inventory.all')}}">Inventory Manage</a></li>
                    <li><a class="nav-link" href="{{url('/admin/coupon/add-event')}}">Inventory Setting</a></li>
                </ul>
            </li>
            <li class="sidebar-list">
                <a href="{{ route('tenant.admin.product.coupon.all') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/Compaigns.svg') }}">
                    </span>
                    <span class="menu-name">Compaigns</span>
                </a>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/job.svg') }}">
                    </span>
                    <span class="menu-name">Jobs</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.job')}}">Add Job</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.job.category')}}">Category</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.job.paid.payment.logs')}}">All Paid Application</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.job.unpaid.payment.logs')}}">All Unpaid Application</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.job.payment.logs.report')}}">Payment job Report</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.job.settings')}}">Setting</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/appointment.svg') }}">
                    </span>
                    <span class="menu-name">Appointments</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment')}}">All Appointments</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.category')}}">Category</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.sub.category')}}">Sub category</a></li>
                    <li><a class="nav-link" href="{{url('subAppointment')}}">All sub Appointments</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.day.types')}}">Appointments day Type</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.days')}}">Appointments day </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.schedule')}}">Appointments Schedules </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.complete.payment.logs')}}">All Payment Logs</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.appointment.payment.logs.report')}}">Appointments Report </a></li>
                    <li><a class="nav-link" href="#">Setting</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/ticket.svg') }}">
                    </span>
                    <span class="menu-name">Support Tickets</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.support.ticket.all')}}">All Tickets</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.support.ticket.new')}}">Add Tickets</a></li>
                    <li><a class="nav-link" href="{{url('departments')}}">Department</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.support.ticket.page.settings')}}">Page Settings</a></li>
                </ul>
            </li>
            <li class="sidebar-list ">
                <a href="{{ route('tenant.admin.brands') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/brand.svg') }}">
                    </span>
                    <span class="menu-name">Brands</span>
                </a>
            </li>
            <li class="sidebar-list ">
                <a href="{{ route('tenant.admin.customDomains') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/country.svg') }}">
                    </span>
                    <span class="menu-name">Custom Domain</span>
                </a>
            </li>
            <li class="sidebar-list ">
                <a href="{{ route('tenant.admin.testmonials') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/Testimonial.svg') }}">
                    </span>
                    <span class="menu-name">Testimonial</span>
                </a>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/builder.svg') }}">
                    </span>
                    <span class="menu-name">Form Builder</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.customForm')}}">Custom From Builder</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.formSubmission')}}">All Form submission</a></li>

                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/package-order.svg') }}">
                    </span>
                    <span class="menu-name">My Package Order</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.mypaymentlog')}}">My Payment Logs</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/pages.svg') }}">
                    </span>
                    <span class="menu-name">Pages</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.allPages')}}">All Pages </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.newPage')}}">New Pages</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/portfolio.svg') }}">
                    </span>
                    <span class="menu-name">Portfolio</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.portfolio')}}">All Portfolio </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.portfolio.new')}}">Add Portfolio</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.portfolio.category')}}">Category</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/blogs.svg') }}">
                    </span>
                    <span class="menu-name">Blogs</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.blog')}}">All Blogs </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.blog.new')}}">Add Blogs</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.blog.category')}}">Category</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.blog.settings')}}">Settings</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/ad.svg') }}">
                    </span>
                    <span class="menu-name">Advertisement</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.allAdvertisement')}}">All Advertisement </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.addAdvertisement')}}">Add Advertisement</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/service.svg') }}">
                    </span>
                    <span class="menu-name">Services</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.service')}}">All Services </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.service.add')}}">Add Services</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.service.category')}}">Category</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/knowledga.svg') }}">
                    </span>
                    <span class="menu-name">Knowledgebase</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.knowledgebase')}}">All Knowledgebase </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.knowledgebase.new')}}">Add Knowledgebase</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.knowledgebase.category')}}">Category</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/faq.svg') }}">
                    </span>
                    <span class="menu-name">Faqs</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.allFaqs')}}">All Faqs </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.categoryFaqs')}}">Category</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/price.svg') }}">
                    </span>
                    <span class="menu-name">Price Plan</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.wedding.price.plan')}}">All Plan </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.wedding.payment.logs')}}">Payment Logd</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/image.svg') }}">
                    </span>
                    <span class="menu-name">Image Gallery</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.allImage')}}">All Gallery </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.categoryImage')}}">Category</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/setting.svg') }}">
                    </span>
                    <span class="menu-name">External Import</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="#">Cj Dropshipping </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.aliExpress')}}">Ali Express</a></li>
                </ul>
            </li>
            <li class="sidebar-list ">
                <a href="{{ route('tenant.admin.product') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/plugin.svg') }}">
                    </span>
                    <span class="menu-name">Integration</span>
                </a>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/setting.svg') }}">
                    </span>
                    <span class="menu-name">Appearance settings</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="#">theme Manage </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.menuManage')}}">Menu Manage </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.widgets')}}">Widgat Builder </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.topBarSetting')}}">Topbar settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.otherSetting')}}">Other settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.404setting')}}">404 settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.maintainanceSetting')}}">Maintenance settings</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/setting.svg') }}">
                    </span>
                    <span class="menu-name">General settings</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.pageSetting')}}">Page Settings </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.siteIdentity')}}">Site Identity </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.pageSetting')}}">Basic Settings </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.colorSetting')}}">Color settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.typography')}}">Typography settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.seoSetting')}}">Seo settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.emailSetting')}}">Email settings</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.thirdParty')}}">Third Party Script</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.css')}}">Custom CSS</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.js')}}">Custom JS</a></li>
                    <li><a class="nav-link" href="#">Cache Settings</a></li>
                    <li><a class="nav-link" href="#">GDPR Settings</a></li>
                    <li><a class="nav-link" href="#">Sitemap Settings</a></li>
                </ul>
            </li>
            <li class="sidebar-list subNav has-submenu">
                <a class="nav-link" href="#!">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/setting.svg') }}">
                    </span>
                    <span class="menu-name">Payment settings</span>
                </a>
                <ul class="submenu collapse subNavList">
                    <li><a class="nav-link" href="{{route('tenant.admin.paymentSetting')}}">Currencies</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.paypal')}}">Paypal </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.stripe')}}">Stripe </a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.manualPayment')}}">Manual payment</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.paytm')}}">Paytm</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.razorPay')}}">Razorpay</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.payStack')}}">Paystack</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.mollie')}}">Mollie</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.payFast')}}">Payfast</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.midTrans')}}">Midtrans</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.cashFree')}}">Cashfree</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.instaMojo')}}">Instamojo</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.marCadoPago')}}">Marcadopago</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.zitoPay')}}">Zitopay</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.squareUp')}}">Squareup</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.cinetPay')}}">Cinetpay</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.payTabs')}}">Paytabs</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.billPlz')}}">Billplz</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.flutterWave')}}">Flutterwave</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.toyyibPay')}}">Toyyibpay</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.pagali')}}">Pagali</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.authorizeNet')}}">Authorizenet</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.sitesWay')}}">Sitesway</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.bankTransfer')}}">Bank Transfer</a></li>
                    <li><a class="nav-link" href="{{route('tenant.admin.kinetic')}}">Kinetic</a></li>
                </ul>
            </li>
            <li class="sidebar-list ">
                <a href="{{ url('/admin/product/list') }}">
                    <span class="icon">
                        <img src="{{ global_asset('assets/landlord/admin/images/translate.svg') }}">
                    </span>
                    <span class="menu-name">Languages</span>
                </a>
            </li>
        </ul>
    </div>
</div>