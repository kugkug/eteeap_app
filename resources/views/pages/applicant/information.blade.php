@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>
    
    <div class="col-md-9">
		<form action="">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h5 class="card-title m-0">Registration</h5>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="">Current Address</label>
						<textarea rows="3" class="form-control" data-key="Address"  data="req">{{ $profile['address']}}</textarea>
					</div>

					<div class="form-group">
						<label for="">Current Position</label>
						<input type="text" class="form-control" placeholder="Position"  data-key="Position" data="req" value="{{ $profile['position']}}">
					</div>
					<div class="form-group">
						<label for="">Company Name</label>
						<input type="text" class="form-control" placeholder="Company Name"  data-key="CompanyName" data="req" value="{{ $profile['company']}}">
					</div>
					<div class="form-group">
						<label for="">Company Address</label>
						<textarea rows="3" class="form-control" data-key="CompanyAddress"  data="req">{{ $profile['company_address']}}</textarea>
					</div>
					
					<div class="form-group">
						<label for="">Skills (separated by comma)</label>
						<textarea rows="6" class="form-control" data-key="Skills">{!! join(", ", explode(",", $profile['skills'])) !!}</textarea>
					</div>
				</div>
				<div class="card-footer clearfix">
					<div class="d-flex justify-content-between">

						<button class="btn btn-outline-success" data-trigger="update">
							<i class="fas fa-save"></i> Update
						</button>

						<a class="btn btn-outline-danger" href="/dashboard">
							<i class="fa fa-undo"></i> Cancel
						</a>

					</div>
				</div>
			</div>
		</form>

    </div>
</div>
@include('partials.footer')
<script src="{{asset('scripts/modules/profile.js')}}"></script>