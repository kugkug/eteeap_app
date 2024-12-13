@include('partials.header')

<div class="row">
    <div class="col-md-3">
      	@include('partials.profile')
    </div>
    
    <div class="col-md-9">
		<form action="">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title text-primary">
						<i class="fas fa-folder"></i>
						Documents
					</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-documents">
						<i class="fa fa-folder-open"></i>
						</button>

						<span class="badge badge-danger navbar-badge" id="document-counter">
							{{ sizeof($documents) }}
						</span>
					</div>

				</div>
				<div class="card-body">
					
					<div class="row">
						<div class="col-md-12">					
							<div class="file-drop-area text-center">

								<div>
									<span class="choose-file-button">Choose file</span>
									<span class="file-message">or drag and drop files here</span>
									<input class="file-input" type="file">
									<br />
								
								</div>
							</div>

						</div>
					</div>

					<div class="row d-none">
						<div class="col-md-12">					
							<iframe src="" frameborder="0" id="file-to-upload"></iframe>
						</div>
					</div>
						
				</div>
				<div class="card-footer d-none">
					<div class="d-flex justify-content-between">
						<button class="btn btn-outline-primary" id="btn-upload">
							<i class="fas fa-file-upload"></i> Upload
						</button>

						<button class="btn btn-outline-danger" id="btn-reset">
							<i class="fas fa-undo"></i> Cancel
						</button>
					</div>
				</div>
			</div>
		</form>				
    </div>
</div>

<div class="modal fade" id="modal-documents" aria-modal="true" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="fa fa-briefcase"></i>
					Documents
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				  </button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<ul class="nav flex-column">
							
							@if (count($documents) > 0) 
								@foreach ($documents as $document)
								<li class="nav-item">
									<a href="#" data-link={{ asset('documents/' . $document['filename']) }} class="nav-link">
									  {{ $document['original_filename']}}
									</a>
								  </li>	
								@endforeach
							@endif
						  </ul>
					</div>
					<div class="col-md-8">
						<iframe src="" frameborder="0" id="file-to-view"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@include('partials.footer')

<script src="{{asset('scripts/modules/documents.js')}}"></script>