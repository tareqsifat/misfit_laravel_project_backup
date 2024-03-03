@extends('web.layout.index')

@section('content')
<style>
    .main-container{
        background-color: #d0ddff;
        padding: 0;
        border-radius: 10px;
        overflow: hidden; 
    }
    .image-parent{
        position: relative;
    }
    .image-parent::before {
        content: ''; /* Ensure content property is defined for pseudo-elements */
        position: absolute;
        top: 80px;
        left: 20px;
        height: 110px;
        width: 110px;
        background-color: #d0ddff;
        background-image: url('https://cdn1.vectorstock.com/i/1000x1000/90/35/avatar-men-design-vector-14499035.jpg');
        background-size: cover;
        border-radius: 50%; /* Ensure a circular shape */
        content: ''; /* Add this line to ensure content is properly cleared */
    }
    .image-parent img{
        max-width: 100%;
        border-radius: 10px;
    }
    .main-content-holder{
        padding-top: 20px
    }
    .section-padding{
        background: linear-gradient(to bottom right, rgb(0, 11, 24, 1), rgb(7, 58, 124, 1));
        /* background: linear-gradient(90deg, rgb(0, 11, 24, 1), rgb(0, 26, 140),  rgb(7, 58, 124, 1)); */
        padding-top: 120px;
        padding-bottom: 120px;
    }
    .quick-menu .card-body{
        padding: 0 0 0 0;
    }
    .quick-menu .list-group{
        border-radius: 0px;
    }
    .quick-menu .list-group-item{
        margin: 1px 0px 0px;
    }
    .content-holder {
        padding: 0.5rem;
        margin: .5rem;
        border: 1px solid rgba(0, 0, 0, 0.175);
        border-radius: 5px;
        background-color: #fcfbf9!important;
    }
    .content-holder .content-header{
        padding-left: 5px;
    }

    .pencil-icon{
        padding: 1px 7px;
    }
    .link-icon {
        border: 1px solid black;
        border-radius: 50% 54% 53% 55%;
        background-color: #d2e0fc75;
    }
    .plus-icon{
        padding: 1px 7px;
    }
    .section-header {
        height: 50px;
        border-radius: 5px;
        background-color: #002b6a;
        margin-bottom: 2px;
        color: #dee5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
</style>
<div class="section-padding seciton">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="card text-white bg-primary mb-3 quick-menu" >
                            <div class="card-header">Quick Menu</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Experiences</li>
                                    <li class="list-group-item">Skills</li>
                                    <li class="list-group-item">Educations</li>
                                    <li class="list-group-item">Certifications</li>
                                    <li class="list-group-item">Projects</li>
                                    <li class="list-group-item">Badges</li>
                                    <li class="list-group-item">Achivements</li>
                                    <li class="list-group-item">Carrer objective</li>
                                  </ul>
                            </div>
                        </div>          
                    </div>
                    <div class="col-7 main-container">
                        <div class="image-parent">
                            <img src="{{ asset('assets/web/images/cover.jpeg') }}" alt="">
                        </div>
                        <div class="main-content-holder">
                            <div class="content-holder">
                                <span class="content-header"><strong>Saved Addresses:</strong></span>
                                <a href="{{ route('address.create') }}" class="link-icon plus-icon float-end text-center"
                                   style="margin-right: 10px; margin-top: -3px">
                                    <i class="fa fa-plus"></i>
                                </a>
                                @forelse($addresses as $address)
                                    <div class="card m-1">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <span>{{ $address->address_line }}</span><br/>
                                                        <span><strong>City:</strong>{{ $address->getCityName() }}</span>
                                                        <span><strong>State:</strong>{{ $address->getStateName() }}</span>
                                                        <span><strong>Country:</strong>{{ $address->getCountryName()  }}</span>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="{{ route('address.edit', $address->id) }}" class="link-icon pencil-icon text-center">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card m-1">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <span>There are no saved addresses</span>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="" class="link-icon plus-icon text-center">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="content-holder">
                                <span class="content-header"><strong>Experiences:</strong></span>
                                <a href="{{ route('experience.create') }}" class="link-icon plus-icon float-end text-center"
                                   style="margin-right: 10px; margin-top: -3px">
                                    <i class="fa fa-plus"></i>
                                </a>
                                @foreach($experiences as $experience)
                                    <div class="card m-1">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <span class="d-block"><strong>{{ $experience->company ? $experience->company->name : '' }}</strong></span>
                                                        <span class="d-block">{{ $experience->job_title }}</span>
                                                        <span class="d-block"><strong>State:</strong> {{ $experience->getStateName() }}</span>
                                                        <span class="d-block"><strong>Country:</strong>{{ $experience->getCountryName() }}</span>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="{{ route('experience.edit', $experience->id) }}" class="link-icon pencil-icon text-center">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="content-holder">
                                <span class="content-header"><strong>Skills:</strong></span>
                                <a href="{{ route('skill.create') }}" class="link-icon plus-icon float-end text-center"
                                   style="margin-right: 10px; margin-top: -3px">
                                    <i class="fa fa-plus"></i>
                                </a>
                                @foreach($experiences as $experience)
                                    <div class="card m-1">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <span class="d-block"><strong>{{ $experience->company ? $experience->company->name : '' }}</strong></span>
                                                        <span class="d-block">{{ $experience->job_title }}</span>
                                                        <span class="d-block"><strong>State:</strong> {{ $experience->getStateName() }}</span>
                                                        <span class="d-block"><strong>Country:</strong>{{ $experience->getCountryName() }}</span>
                                                    </div>
                                                    <div class="col-1">
                                                        <a href="{{ route('skill.edit', $experience->id) }}" class="link-icon pencil-icon text-center">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>


                    </div>
                    <div class="col-3">
                        <div class="section-header">
                            Recent blogs
                        </div>
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Primary card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Secondary card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Success card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Danger card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Warning card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Info card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card bg-light mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Light card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header">Header</div>
                            <div class="card-body">
                                <h5 class="card-title">Dark card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection