@include('partials.header_guest')

<div class="row">
    
    <div class="col-md-12">
        <form action="">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Email Verification</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Enter OTP Code to verify {{ base64_decode($email) }}</label>
                        <input type="text" class="form-control" placeholder="xxxxxx" data-key="Otp" data="req" maxlength="6">
                    </div>
                    
                </div>
                <div class="card-footer clearfix">

                    <button class="btn btn-outline-success float-right" data-trigger="submit">
                        <i class="fas fa-certificate"></i> Verify
                    </button>

                </div>
            </div>
        </form>
    </div>
   
</div>
@include('partials.footer')
<script src="{{asset('scripts/modules/verify_email.js')}}"></script>