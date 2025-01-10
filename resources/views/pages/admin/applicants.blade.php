
@include('partials.admin.header')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">
                <i class="fa fa-users"></i> Applications
            </h3>

            
        </div>
        <!-- /.card-header -->
        <div class="card-body">
              <div class="dataTables_wrapper dt-bootstrap4">
                  <div class="table-responsive div-table-data"></div>
                  <div class="row paginator">
                  
                  </div>
              </div>
          </div>
        <!-- /.card-body -->
      </div>
</div>
@include('partials.admin.footer')

<script src="{{asset('scripts/modules/applications.js')}}"></script>