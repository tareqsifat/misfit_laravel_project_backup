@extends('web.layout.index')

@section('content')
    <div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-2.webp" data-overlay="50">
        <div class="container">
            <div class="page-heading-content text-center">
                <h3 class="title">Full Stack Backend Developer</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="job-list.html">Jobs</a></li>
                    <li class="breadcrumb-item active">Full Stack Backend Developer</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section section-padding">
        <div class="container">
            <div class="row mb-n5">

                <!-- Job List Details Start -->
                <div class="col-lg-8 col-12 mb-5 pe-lg-5">
                    <div class="job-list-details">
                        <div class="job-details-head row mx-0">
                            <div class="company-logo col-auto">
                                <a href="company-single.html"><img src="assets/images/companies/company-1.png" alt="Company Logo"></a>
                            </div>
                            <div class="salary-type col-auto order-sm-3">
                                <span class="salary-range">$5000 - $8000</span>
                                <span class="badge bg-success">Full Time</span>
                            </div>
                            <div class="content col">
                                <h5 class="title">Full Stack Backend Developer</h5>
                                <ul class="meta">
                                    <li><strong class="text-primary"><a href="company-single.html">Envato</a></strong></li>
                                    <li><i class="fa fa-map-marker"></i> 2023 Willshire Glen, GA-30009</li>
                                </ul>
                            </div>
                        </div>
                        <div class="job-details-body">
                            <h6 class="mb-3">Job Description</h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique, ex iusto! Tenetur iusto dolore amet voluptates esse? Ut debitis perferendis, impedit ullam ea officia sapiente soluta cupiditate molestiae eius enim aut laboriosam, saepe deleniti. Excepturi nobis amet fugit ipsa corrupti!</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo ratione odit qui inventore maiores labore tenetur earum! Quam eaque, deleniti quibusdam deserunt quos reprehenderit dolor, in quo voluptates maxime nostrum.</p>
                            <h6 class="mb-3 mt-4">Responsibilities</h6>
                            <ul>
                                <li>Proven work experienceas a web designer</li>
                                <li>Demonstrable graphic design skills with a strong portfolio</li>
                                <li>Proficiency in HTML, CSS and JavaScript for rapid prototyping</li>
                                <li>Experience working in an Agile/Scrum development process</li>
                                <li>Proven work experienceas a web designer</li>
                                <li>Excellent visual design skills with sensitivity to user-system interaction</li>
                                <li>Ability to solve problems creatively and effectively</li>
                                <li>Proven work experienceas a web designer</li>
                                <li>Up-to-date with the latest Web trends, techniques and technologies</li>
                                <li>BS/MS in Human-Computer Interaction, Interaction Design or a Visual Arts subject</li>
                            </ul>
                            <h6 class="mb-3 mt-4">Education + Experience</h6>
                            <ul>
                                <li>Advanced degree or equivalent experience in graphic and web design</li>
                                <li>3 or more years of professional design experience</li>
                                <li>Direct response email experience</li>
                                <li>Ecommerce website design experience</li>
                                <li>Familiarity with mobile and web apps preferred</li>
                                <li>Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback</li>
                                <li>Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service</li>
                                <li>Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices</li>
                            </ul>
                            <h6 class="mb-3 mt-4">Benefits</h6>
                            <ul>
                                <li>Medical insurance</li>
                                <li>Dental insurance</li>
                                <li>Vision insurance</li>
                                <li>Supplemental benefits (Short Term Disability, Cancer & Accident).</li>
                                <li>Employer-sponsored Basic Life & AD&D Insurance</li>
                                <li>Employer-sponsored Long Term Disability</li>
                                <li>Employer-sponsored Value Adds – Fresh Beanies</li>
                                <li>401(k)with matching</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Job List Details End -->

                <!-- Job Sidebar Wrap Start -->
                <div class="col-lg-4 col-12 mb-5">
                    <div class="sidebar-wrap">
                        <!-- Sidebar (Apply Buttons) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <div class="row m-n2">
                                    <div class="col-xl-auto col-lg-12 col-sm-auto col-12 p-2">
                                        <a href="#" class="d-block btn btn-outline-secondary"><i class="fa fa-heart-o me-1"></i> Save Job</a>
                                    </div>
                                    <div class="col-xl-auto col-lg-12 col-sm-auto col-12 p-2">
                                        <a href="#" class="d-block btn btn-primary">Apply Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar (Apply Buttons) End -->

                        <!-- Sidebar (Job Overview) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <h6 class="title">Job Overview</h6>
                                <ul class="job-overview list-unstyled">
                                    <li><strong>Published on:</strong> Nov 6, 2023</li>
                                    <li><strong>Vacancy:</strong> 02</li>
                                    <li><strong>Employment Status:</strong> Full-time</li>
                                    <li><strong>Experience:</strong> 2 to 3 year(s)</li>
                                    <li><strong>Job Location:</strong> Willshire Glen</li>
                                    <li><strong>Salary:</strong> $5k - $8k</li>
                                    <li><strong>Gender:</strong> Any</li>
                                    <li><strong>Application Deadline:</strong> Dec 15, 2023</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar (Job Overview) End -->

                        <!-- Sidebar (Job Location) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <h6 class="title">Job Location</h6>
                                <!-- Google Map Area Start -->
                                <div class="job-location-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2224905.8379164026!2d-63.27089988050263!3d-2.8569688249815943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e8605342744385%3A0x3d3c6dc1394a7fc7!2sAmazon%20Rainforest!5e0!3m2!1sen!2sbd!4v1635401091721!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <!-- End of Google Map Area -->
                            </div>
                        </div>
                        <!-- Sidebar (Job Location) End -->
                    </div>
                </div>
                <!-- Job Sidebar Wrap End -->

            </div>
        </div>
    </div>
@endsection
