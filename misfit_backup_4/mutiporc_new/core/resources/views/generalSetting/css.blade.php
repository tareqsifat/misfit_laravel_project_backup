@extends(route_prefix().'admin.admin-master')
@section('content')

<head>

    <head>
        <title>Live CSS Editor</title>
        <style>
            #editor-container {
                display: flex;
            }

            #line-numbers {
                width: 40px;
                padding: 10px;
                border-right: 1px solid #ccc;
                white-space: pre;
            }

            #css-editor {
                flex: 1;
                height: 300px;
            }
        </style>
    </head>
    <div class="main-heading-container">
        <div class="common-title">Custom Css</div>
    </div>
    <div class="card-common">
        <div class="card-common-body">
            <div class="row">
                <div class="col-sm-12">
                <form action="" method="POST" enctype="multipart/form-data">

                    <h4 class="text-dark ml-4" style="font-weight: bold;">Custom Css</h4>
                    <div class="col-md-12 form-group mt-4">
                        <div id="editor-container">
                            <div id="line-numbers"></div>
                            <textarea id="css-editor"></textarea>
                        </div>
                    </div>
                    <div id="output"></div>
                    <div class="btnWrapperPrimary ml-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endsection