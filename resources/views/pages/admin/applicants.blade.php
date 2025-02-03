
@include('partials.admin.header')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-users"></i> Applications
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
        <div class="card-body">
              <div class="dataTables_wrapper dt-bootstrap4">
                  <div class="table-responsive div-table-data"></div>
                  <div class="row paginator">
                  
                  </div>
              </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-danger" data-trigger="download-pdf">
                <i class="fa fa-file-pdf"></i> Download PDF
            </button>
        </div>
    </div>
</div>
@include('partials.admin.footer')

<script src="{{asset('scripts/modules/applications.js')}}"></script>