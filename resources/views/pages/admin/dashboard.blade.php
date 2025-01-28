@include('partials.admin.header')

<div class="row">		
		<div class="col-lg-3 col-6">
		  <!-- small box -->
		  <div class="small-box bg-info">
			<div class="inner">
				
			  <h3>{{$dashboard['applications'][0]->total}}</h3>

			  <p>New Applications</p>
			</div>
			<div class="icon">
			  <i class="ion ion-bag"></i>
			</div>
			<a href="/administrator/applications" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
		  <!-- small box -->
		  <div class="small-box bg-success">
			<div class="inner">
				<h3>{{$dashboard['applications'][1]->total ?? 0}}</h3>

			  <p>Approved Applications</p>
			</div>
			<div class="icon">
			  <i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
			
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
		  <!-- small box -->
		  <div class="small-box bg-warning">
			<div class="inner">
				<h3>{{$dashboard['documents']}}</h3>

			  <p>Documents Uploaded</p>
			</div>
			<div class="icon">
			  <i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->

@include('partials.admin.footer')