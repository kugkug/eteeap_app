
@include('partials.admin.header')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-users"></i> Applicants
                </h3>

                <div class="card-tools">
                    <select data-key="Courses" class="form-control" >
                        <option value="">Courses</option>
                        @foreach ($courses as $course_code => $course_desc)
                            <option value="{{$course_code}}" >{{$course_desc}}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body overflow-auto">
                
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="table-responsive div-table-data">
                        
                    </div>
                </div>
    
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-envelope"></i> For Invite
                </h3>

                <div class="card-tools">
                    <button class="btn btn-success float-right" data-trigger="create-invite">
                        <i class="fa fa-edit"></i> Create Invite
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body overflow-auto">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="table-responsive "></div>
                    <table class="table table-hover">
                        <thead> 
                            <tr> 
                                <th> Action </th> 
                                <th> Fullname </th> 
                                <th> Desired Course </th> 
                            </tr>
                        </thead> 
                        <tbody class="div-table-batch">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- /.card-body -->
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
                    <button class="btn btn-danger" data-trigger="send-bulk-email">
                        <i class="fas fa-mail-bulk"></i> Send Bulk Invitation
                    </button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </form>
    </div>
</div>

@include('partials.admin.footer')

<script src="{{asset('scripts/modules/batch.js')}}"></script>