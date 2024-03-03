@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">SMTP Settings</div>
</div>
<div class="card-common">
    <div class="card-common-body">
        <div class="row">
            <div class="col-sm-5">
                <form action="" method="POST" enctype="multipart/form-data">
                    <h4 class="" style="font-weight: bold;">SMTP Setting</h4>
                    <span class="text-secondary mt-4">you can also do change smtp settings manually from @core>.env files.</span>
                    <div class="col-md-12 form-group mt-4">
                        <label>Site Global Email</label>
                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                        <span class="text-primary">you will get all mail to this email, also this will be in your user form address in all the mail send from the system.</span>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP host</label>
                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP Username</label>
                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP Password</label>
                        <input type="password" name="p_c_t_e" value="" class="form-control" placeholder="">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP Driver</label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="">
                            <option value="">SMTP</option>
                            <option value="">Sendmail</option>
                            <option value="">mailgun</option>
                            <option value="">post mark</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP Port</label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="">
                            <option value="">25</option>
                            <option value="">587</option>
                            <option value="">465</option>
                            <option value="">2525</option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>SMTP Encryption</label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="">
                            <option value="">SSL</option>
                            <option value="">TSL</option>
                            <option value="">none</option>
                        </select>
                    </div>
                    <div class="btnWrapperPrimary">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <h4 class="font-weight-bold" style="font-weight: bold;">Send Test Mail</h4>
                <span class="text-secondary mt-4">if you see any error here, please contact your hosting provider to make sure you have added valid and proper smtp details.</span>
                <div class="col-md-12 form-group mt-4">
                    <label>Email</label>
                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Email">
                </div>
                <div class="btnWrapperPrimary">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Send Test Mail</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection