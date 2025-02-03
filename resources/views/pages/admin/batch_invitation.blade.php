
@include('partials.admin.header')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-users"></i> Applicants
                </h3>

                <div class="card-tools">
                    <select data-key="Courses" class="form-control form-control-sm" >
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
                    <button class="btn btn-success btn-sm float-right">
                        <i class="fa fa-edit"></i> Compose
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

{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-envelope"></i> For Invite
                </h3>

                <div class="card-tools">
                    <button class="btn btn-success btn-sm float-right">
                        <i class="fa fa-edit"></i> Compose
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body overflow-auto">
                
            </div>

            <!-- /.card-body -->
        </div>
    </div>
</div> --}}

@include('partials.admin.footer')

<script src="{{asset('scripts/modules/batch.js')}}"></script>