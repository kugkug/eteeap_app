@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>
	<div class="col-md-9">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title text-primary">
					<i class="fas fa-calendar-week"></i>
					Timeline
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-documents">
                        <i class="fas fa-calendar-week"></i>
                        Details
                    </button>
				</div>

			</div>
			<div class="card-body">
				<div class="container mb-5">                      
					<div class="row text-center justify-content-center mb-1">
						<div class="col-xl-6 col-lg-8">
							<h2 class="font-weight-bold">Applicant's Timeline</h2>
						</div>
					</div>
					
					<div class="row">
						<div class="col">
							<div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
								<div class="timeline-step">
									<div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
										<div class="inner-circle-success"></div>
										{{-- <p class="h6 mt-3 mb-1">2003</p> --}}
										<p class="h6 text-muted mb-0 mb-lg-0">Registered</p>
									</div>
								</div>
								<div class="timeline-step">
									<div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
										@if(in_array('profile', $timeline))
											@php
												$class = "inner-circle-success";
											@endphp
										@else
											@php
												$class = "inner-circle";
											@endphp
										@endif
										<div class="{{ $class }}"></div>
										{{-- <p class="h6 mt-3 mb-1">2004</p> --}}
										<p class="h6 text-muted mb-0 mb-lg-0">Profile Update</p>
									</div>
								</div>
								<div class="timeline-step">
									<div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
										@if(in_array('upload', $timeline))
											@php
												$class = "inner-circle-success";
											@endphp
										@else
											@php
												$class = "inner-circle";
											@endphp
										@endif
										<div class="{{ $class }}"></div>
										{{-- <p class="h6 mt-3 mb-1">2005</p> --}}
										<p class="h6 text-muted mb-0 mb-lg-0">Documents Upload</p>
									</div>
								</div>
								<div class="timeline-step">
									<div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
										@if(in_array('interview', $timeline))
											@php
												$class = "inner-circle-success";
											@endphp
										@else
											@php
												$class = "inner-circle";
											@endphp
										@endif
										<div class="{{ $class }}"></div>
										{{-- <p class="h6 mt-3 mb-1">2010</p> --}}
										<p class="h6 text-muted mb-0 mb-lg-0">For Interview</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>	
    
    
	<div class="modal fade" id="modal-documents" aria-modal="true" role="dialog">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fas fa-calendar-week"></i>
						History	
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					  </button>
				</div>
				<div class="modal-body">
	
					<div class="row">
						<div class="col-md-12">
							<div class="timeline">

								@foreach ($timelines as $date => $arr_timeline)
									<div class="time-label">
										<span class="bg-info">{{ $date }}</span>
									</div>

									@foreach ($arr_timeline as $timeline)
									<div>
										@if($timeline['action'] == 'upload')
											<i class="fas fa-upload bg-blue"></i>
										
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock"></i> {{ date("h:i a", strtotime($timeline['created_at'])) }}</span>
												<h3 class="timeline-header">
													<a href="#" class="text-primary">Documents Uploaded</a>
												</h3>

			
												<div class="timeline-body">
													{!! $timeline['description'] !!}
												</div>
											</div>
										@elseif($timeline['action'] == 'approve')
											
											<i class="fas fa-thumbs-up bg-green"></i>
										
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock"></i> {{ date("h:i a", strtotime($timeline['created_at'])) }}</span>
												<h3 class="timeline-header">
													<a href="#" class="text-success">Admin Approved</a>
												</h3>

			
												<div class="timeline-body">
													{!! $timeline['description'] !!}
												</div>
											</div>
											
										@elseif($timeline['action'] == 'revise')

											<i class="fas fa-thumbs-down bg-red"></i>
											
											<div class="timeline-item">
												<span class="time"><i class="fas fa-clock"></i> {{ date("h:i a", strtotime($timeline['created_at'])) }}</span>
												<h3 class="timeline-header">
													<a href="#" class="text-danger">Admin Reject</a>
												</h3>


												<div class="timeline-body">
													{!! $timeline['description'] !!}
												</div>
											</div>
										@endif
									</div>
									@endforeach
								@endforeach
						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('partials.footer')