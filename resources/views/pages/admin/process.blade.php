
@include('partials.admin.header')

<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">
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
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-folder"></i> 
                Documents
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                  <div class="nav flex-column nav-tabs h-100" role="tablist" aria-orientation="vertical">
            
                    @foreach ($req_types as $req_type)
                        <a class="nav-link" data-toggle="pill"
                            href="#req-tab-{{$req_type['id']}}" 
                            role="tab" 
                            aria-controls="req-tab-{{$req_type['id']}}" 
                            aria-selected="false"
                        >
                            {{ $req_type['title']}}	
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
                                        <div class="card card-outline card-warning m-2">
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
            
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-stream"></i>
                Timeline
            </h3>
        </div>
        <div class="card-body">
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
@include('partials.admin.footer')

<script src="{{asset('scripts/modules/process.js')}}"></script>