@extends('admin.layout.admin')
@section('content')
@include('admin.part.alart')
    <!-- BEGIN: Responsive Table -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Footer
            </h2>
        </div>
        <div class="p-5" id="responsive-table">
            <div class="preview">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Field</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Data</th>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Action</th>
                            </tr>
                        </thead>
                        {{-- <img src="/" alt="" height="50px"> --}}
                        <tbody>
                            @foreach ($collection as $key=>$item)
                                <tr>
                                    <td class="border-b whitespace-nowrap">Company Name</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->company_name }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" 
                                            class="btn btn-warning waves-effect waves-light m-1 booltip"
                                            onclick="viewClose('singleform0')">
                                            {{-- booltip is a custop tooltip arrtibute, made for avoiding same name conflict with tooltip comes with template --}}
                                            <i class="fas fa-pencil-alt"></i>
                                            <div class="booltiptext">Edit Company</div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="singleform0" style="display: none">
                                        @include('admin.include.single_update',[
                                            'item' => $item,
                                            'name' => 'company_name',
                                            'fname' =>'singleform0'
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b whitespace-nowrap">Email</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->email }}</td>
                                        <td class="border-b whitespace-nowrap">
                                            <a type="button" 
                                                class="btn btn-warning waves-effect waves-light m-1 booltip"
                                                onclick="viewClose('singleform1')">
                                                <i class="fas fa-pencil-alt"></i>
                                                <div class="booltiptext">Edit Email</div>
                                            </a>
                                        </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="singleform1" style="display: none">
                                        @include('admin.include.single_update',[
                                            'item' => $item,
                                            'name' => 'email',
                                            'fname' =>'singleform1'
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b whitespace-nowrap">Phone</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->phone }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" 
                                            class="btn btn-warning waves-effect waves-light m-1 booltip"
                                            onclick="viewClose('singleform2')">
                                            <i class="fas fa-pencil-alt"></i>
                                            <div class="booltiptext">Edit phone</div>
                                        </a>
                                    </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="singleform2" style="display: none">
                                        @include('admin.include.single_update',[
                                            'item' => $item,
                                            'name' => 'phone',
                                            'fname' =>'singleform2'
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b whitespace-nowrap">Facebook</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->facebook }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" 
                                            class="btn btn-warning waves-effect waves-light m-1 booltip"
                                            onclick="viewClose('singleform3')">
                                            <i class="fas fa-pencil-alt"></i>
                                            <div class="booltiptext">Edit Facebook</div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="singleform3" style="display: none">
                                        @include('admin.include.single_update',[
                                            'item' => $item,
                                            'name' => 'facebook',
                                            'fname' =>'singleform3'
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b whitespace-nowrap">Feed</td>
                                    <td class="border-b whitespace-nowrap">{{ $item->feed }}</td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" 
                                            class="btn btn-warning waves-effect waves-light m-1 booltip"
                                            onclick="viewClose('singleform4')">
                                            <i class="fas fa-pencil-alt"></i>
                                            <div class="booltiptext">Edit Feed</div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="singleform4" style="display: none">
                                        @include('admin.include.single_update',[
                                            'item' => $item,
                                            'name' => 'feed',
                                            'fname' =>'singleform4'
                                        ])
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="border-b whitespace-nowrap">
                                        <a type="button" href="{{ route('footer.edit', $item->id) }}" 
                                            class="btn btn-warning waves-effect waves-light m-1">
                                            <i class="fas fa-pencil-alt"></i>&nbsp;
                                            <span>Edit All</span> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{-- {!! $collection->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function viewClose(name){
            for (let index = 0; index < 5; index++) {
                if(name == ("singleform"+index)){
                    document.getElementById(("singleform"+index)).style.display='block';
                }
                else{
                    document.getElementById("singleform"+index).style.display='none';
                }
            }
            // if(name == 'singleform0'){
            //     document.getElementById(name).style.display='block';
            //     document.getElementById('singleform1').style.display='none';
            //     document.getElementById('singleform2').style.display='none';
            //     document.getElementById('singleform3').style.display='none';
            //     document.getElementById('singleform4').style.display='none';
            // }
            // if(name == 'singleform1'){
            //     document.getElementById(name).style.display='block';
            //     document.getElementById('singleform0').style.display='none';
            //     document.getElementById('singleform2').style.display='none';
            //     document.getElementById('singleform3').style.display='none';
            //     document.getElementById('singleform4').style.display='none';
            // }
            // if(name == 'singleform2'){
            //     document.getElementById(name).style.display='block';
            //     document.getElementById('singleform0').style.display='none';
            //     document.getElementById('singleform1').style.display='none';
            //     document.getElementById('singleform3').style.display='none';
            //     document.getElementById('singleform4').style.display='none';
            // }
            // if(name == 'singleform3'){
            //     document.getElementById(name).style.display='block';
            //     document.getElementById('singleform0').style.display='none';
            //     document.getElementById('singleform2').style.display='none';
            //     document.getElementById('singleform1').style.display='none';
            //     document.getElementById('singleform4').style.display='none';
            // }
            // if(name == 'singleform4'){
            //     document.getElementById(name).style.display='block';
            //     document.getElementById('singleform0').style.display='none';
            //     document.getElementById('singleform2').style.display='none';
            //     document.getElementById('singleform3').style.display='none';
            //     document.getElementById('singleform1').style.display='none';
            // }
        }
    </script>
    <!-- END: Responsive Table -->
@endsection