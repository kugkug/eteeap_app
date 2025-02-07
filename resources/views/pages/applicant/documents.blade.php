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
									<input class="file-input" type="file" multiple>
									<br />
								
								</div>
							</div>

						</div>
					</div>

					<div class="row d-none">
						<div class="col-md-12" id="file-to-upload">

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
		
		<?php
			$requirements_type = array_map(function($type) {
				return $type['id'] . "|".$type['title'];
			}, $req_types);
		?>
		
		<input type="hidden" value="{{join("||", $requirements_type)}}" id="txtReqTypes">
		
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
				<select data-key="doc-status" class="form-control w-25 ml-5" >
					<option value="all">All</option>
					@foreach ($document_statuses as $status => $doc_status)
						<option value="{{$status}}">{{$status}}</option>
					@endforeach
				</select>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
			
				
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
					  <div class="nav flex-column nav-tabs h-100" role="tablist" aria-orientation="vertical">
						
						@foreach ($req_types as $req_type)
							@php	
								$status_values = [];
								$status_array = [];    
								$statuses = "";
							@endphp	

							@if(isset($documents[$req_type['id']]))

								@foreach ($documents[$req_type['id']] as $document)
									@if(count($document) > 0)
										@php
											$status_array[] = array_search($document['status'], $document_statuses);
										@endphp
									@else
										@php
											$status_array[] = array_search(0, $document_statuses);
										@endphp
									@endif
								@endforeach
							@endif
							
							
							@if (count($status_array) > 0)
								@php
									$status_values = array_count_values($status_array);
									$statuses = join(" ", array_unique($status_array));
								@endphp
							@endif

							<a class="nav-link mb-1 {{$statuses}}" data-toggle="pill"
								href="#req-tab-{{$req_type['id']}}" 
								role="tab" 
								aria-controls="req-tab-{{$req_type['id']}}" 
								aria-selected="false"
							>
								{{ $req_type['title']}}	

								<div>
									<span class="badge badge-success">{{ $status_values['Approved'] ?? 0 }}</span>
									<span class="badge badge-danger">{{ $status_values['Rejected'] ?? 0}}</span>
									<span class="badge badge-warning">{{$status_values['Pending'] ?? 0}}</span>
								</div>
							</a>
						@endforeach
					  </div>
					</div>
					<div class="col-md-8">
					  <div class="tab-content">
						@if (count($documents) > 0) 
							@foreach ($req_types as $req_type)
								@if(isset($documents[$req_type['id']]))
				
									<div class="tab-pane text-left fade" id="req-tab-{{$req_type['id']}}" role="tabpanel" aria-labelledby="req-tab-{{$req_type['id']}}-tab">
										
										@foreach ($documents[$req_type['id']] as $document)

										<?php
											if ($document['status'] == 1) {
												$card = "card-outline card-success";
											} elseif ($document['status'] == 2) {
												$card = "card-outline card-danger";
											} else {
												$card = "card-outline card-warning";
											}

											$doc_status = array_search($document['status'], $document_statuses);
										?>

										<div class="card m-2 {{ $card }} {{ $doc_status }}"  id="card-doc-{{$document['id']}}">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                {{ $document['original_filename'] }}
                                                </h3>
												<div class="card-tools">
													<button type="button" class="btn btn-sm btn-danger" data-trigger="remove" data-id="{{$document['id']}}">
													<i class="fa fa-trash"></i>
															Remove
													</button>
												</div>
                                            </div>
                                            <div class="card-body">

												<iframe src="{{ asset('documents/' . $document['filename'] ) }}" frameborder="0" id="file-to-view"></iframe>
												<div class="col-md-12 mt-4">
                                                    <textarea class="form-control" rows="5" placeholder="Note:" readonly>{{ $document['notes']}}</textarea>
                                                </div>
                                            </div>
										</div>
										@endforeach
									 </div>
								@else
								<div class="tab-pane text-left fade" id="req-tab-{{$req_type['id']}}" role="tabpanel" aria-labelledby="req-tab-{{$req_type['id']}}-tab">
									No document found!
								 </div>
								@endif
							@endforeach
						@endif
					  </div>
					</div>
				  </div>
			</div>
		</div>
	</div>
</div>

@include('partials.footer')

<script src="{{asset('scripts/modules/documents.js')}}"></script>