@extends('admin.layout.admin')

@section('content')
    <!-- BEGIN: Horizontal Form -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Create Work Description
            </h2>
            <div class="form-check w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <a href="{{ route('ourwork.index') }}" class="btn btn-primary"><i class="icon-backward"></i>&nbsp;Back</a>
            </div>
        </div>
        <form method="POST" class="insert_form" action="{{ route('ourwork.store') }}" enctype="multipart/form-data" id="horizontal-form">
            @csrf
            <div class="preview">
                <div class="form-group p-4">
                    @error('icon')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <label for="horizontal-form-1" class="form-label sm:w-20" >Icon</label>
                    <input type="radio" name="icon"  value="icon-medical-i-womens-health">

                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-womens-health" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-ultrasound">
                 
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-ultrasound" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-cath-lab">
                   
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-cath-lab" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-cardiology">
                  
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-cardiology" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-dental">
                   
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-dental" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-social-services">
                  
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-social-services" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-neurology">
                  
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-neurology" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-imaging-root-category">
                  
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-imaging-root-category" style="font-size: 3rem"></i></label>
                    <input type="radio" name="icon"  value="icon-medical-i-ambulance">
                   
                    <label for="horizontal-form-1" class="form-label sm:w-20"><i class="icon-medical-i-ambulance" style="font-size: 3rem"></i></label>
                    
                </div>
                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20" >Body</label>
                    @error('body')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    <input id="horizontal-form-1" name="body" type="text" class="form-control" placeholder="Body">
                </div>                    

                <div class="form-group p-4">
                    <label for="horizontal-form-1" class="form-label sm:w-20" >Message</label>
                    @error('message')
                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                    @enderror
                    
                    <textarea name="message" id="horizontal-form-1" class="form-control" placeholder="message"></textarea>
                </div>
                <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" style="margin-bottom: 30px" class="btn btn-primary"><i class="icon-lock"></i>&nbsp;Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Horizontal Form -->
@endsection