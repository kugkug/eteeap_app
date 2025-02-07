
@include('partials.admin.header')

<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title text-info">
                    <i class="fa fa-user"></i> 
                    {{
                        ucwords(strtolower($applicant['lastname']. " ".$applicant['firstname']. ", ".$applicant['middlename']))
                        
                    }}
                </h3>
            </div>
            <div class="card-body">
                <dl>
                    <dt>Home Address</dt>
                    <dd>{{ $profile['address'] }}</dd>
                    <dt>Position</dt>
                    <dd>{{ $profile['position'] }}</dd>
                    <dt>Company</dt>
                    <dd>{{ $profile['company'] }}</dd>
                    <dt>Company Address</dt>
                    <dd>{{ $profile['company_address'] }}</dd>
                    <dt>Skills</dt>
                    <dd>{{ $profile['skills'] }}</dd>
                </dl>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
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
</div>
<div class="row">

    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                
                <h3 class="card-title text-success">
                    <i class="fa fa-folder"></i> 
                    Documents
                </h3>
            
                <div class="card-tools d-flex flex-row  justify-content-end w-50">
                    <select data-key="doc-status" class="form-control w-50 mr-2" >
                        <option value="all">All</option>
                        @foreach ($document_statuses as $status => $doc_status)
                            <option value="{{$status}}">{{$status}}</option>
                        @endforeach
                    </select>
                    
                </div>            
                
            </div>
            <div class="card-body">
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
                        <div class="tab-content div-document-tab">
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
                                                <div class="card {{ $card }} m-2 {{ $doc_status }}">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                        {{ $document['original_filename'] }}
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <iframe src="{{ asset('documents/' . $document['filename'] ) }}" frameborder="0" id="file-to-view"></iframe>

                                                        <div class="col-md-12 mt-4">
                                                            <textarea class="form-control" rows="5" placeholder="Note:"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="card-footer">
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-success" data-trigger="approve" data-id="{{$document['id']}}">
                                                                Accept
                                                            </button>

                                                            <button class="btn btn-danger" data-trigger="revise" data-id="{{$document['id']}}">
                                                                Revise
                                                            </button>
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
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success" data-trigger="create-invite" data-id="{{ $applicant['id'] }}">
                        Invite for Interview
                    </button>

                    <button type="button" class="btn btn-danger" data-trigger="download-zip" data-id="{{ $applicant['id'] }}">
                        <i class="fas fa-file-archive"></i>
                        Download to Zip File
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-none" id="div-send-invitation">
    <div class="col-md-12">
        <form action="">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-mail-bulk"></i> Send Invitation
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">Approved Course</label>
                            <select data-key="ApprovedCourse" class="form-control">
                                <option value="">Courses</option>
                                @foreach ($courses as $course_code => $course_desc)
                                    <option value="{{$course_code}}" >{{$course_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Interview Date</label>
                            <input type="date" class="form-control" data-key="InterviewDate" placeholder="Interview Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Interview Time</label>
                            <input type="time" class="form-control" data-key="InterviewTime" placeholder="Interview Time">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                    <p class="text-muted">Note: 
                        <strong>Applications included in this bulk email will be automatically approved!</strong>
                    </p>
                    <button class="btn btn-danger" data-trigger="send-bulk-email" data-id="{{ $applicant['id'] }}">
                        <i class="fas fa-mail-bulk"></i> Send Bulk Invitation
                    </button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
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


@include('partials.admin.footer')

<script src="{{asset('scripts/modules/process.js')}}"></script>