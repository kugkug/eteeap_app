@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>
    
    <div class="col-md-9">
		<section class="container">
			<div class="row justify-content-around">
				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-suitcase"></i>
								<p class="mt-3">PORTFOLIO</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-user-tie"></i>
								<p class="mt-3">INFORMATION</p>
								
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-user-graduate"></i>
								<p class="mt-3">EDUCATION</p>
							</div>
						</div>
					</a>
				</div>
				
			</div>
	
			<div class="row justify-content-around">
				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-user-tag"></i>
								<p class="mt-3">EXPERIENCE</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-calendar-alt"></i>
								<p class="mt-3">TIMELINE</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="#">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-comments"></i>
								<p class="mt-3">MESSAGES</p>
							</div>
						</div>
					</a>
				</div>
				
			</div>

		</section>
    </div>
</div>
@include('partials.footer')