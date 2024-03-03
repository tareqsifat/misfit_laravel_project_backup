@extends('admin.layout.admin')


@section('content')
    
    <div class="clearfix"></div>

            <div class="content-wrapper">
                <div class="container-fluid">
                  @include('admin.includes.brade_cumb',['title' => 'DASHBOARD'])
                    <div class="row">
                        <div class="col-lg-12">
                            {{-- <div style="height: 600px;"> --}}
                                <!--Please remove the height before using this page-->
                               {{-- @section('inner_content') --}}
                               <form class="row" method="POST" action="{{route('test_route')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="col-sm-2 col-form-label">
                                        <label for="input-21">Icon</label>
                                        <input type="file" name="fm_file" class="form-control" id="input-21"/> 
                                        <button type="submit"></i>Add Test</button>
                                    </div>
                               </form>  
                            </div>
                        </div>
                    </div>
                    <!--start overlay-->
                    <div class="overlay"></div>
                    <!--end overlay-->
                </div> 
                <!-- End container-fluid-->
            </div>
            <!--End content-wrapper-->




@endsection
            



          