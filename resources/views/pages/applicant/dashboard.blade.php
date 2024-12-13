@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>
    
    <div class="col-md-9">
		<section class="container">
			<div class="row justify-content-around">
				<div class="col-md-3">
					<a href="/information">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-user-tie"></i>
								<p class="mt-3">INFORMATION</p>
								
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="uploads">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-folder"></i>
								<p class="mt-3">DOCUMENTS</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="education">
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
					<a href="experience">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-user-tag"></i>
								<p class="mt-3">EXPERIENCE</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3">
					<a href="timeline">
						<div class="small-box bg-default box-button">
							<div class="inner text-center">
								<i class="fas fa-calendar-alt"></i>
								<p class="mt-3">TIMELINE</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3">
					<a href="messages">
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