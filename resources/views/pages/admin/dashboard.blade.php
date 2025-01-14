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
			
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
		  <!-- small box -->
		  <div class="small-box bg-success">
			<div class="inner">
				<h3>{{$dashboard['applications'][1]->total}}</h3>

			  <p>Approved Applications</p>
			</div>
			<div class="icon">
			  <i class="ion ion-stats-bars"></i>
			</div>
			
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
			
		  </div>
		</div>
		<!-- ./col -->

@include('partials.admin.footer')