@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>

	
    
    <div class="col-md-9">
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
@include('partials.footer')