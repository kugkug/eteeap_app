@include('partials.header')

<div class="row">
    <div class="col-lg-6">
      <div class="card card-danger card-outline">
        <div class="card-body">
          <h5 class="card-title">News Section</h5>

          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the card's
            content.
          </p>
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div>
      </div><!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
      

      <div class="card card-danger card-outline">
        <div class="card-header">
          <h5 class="card-title m-0">Registration</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Firstname</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Firstname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Middlename</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Middlename">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Lastname</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Lastname">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Birthdate</label>
                <input type="date" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>
              
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
              </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success btn-block">Sign Up</button>
            </div>
        </div>
        
    </div>
    <!-- /.col-md-6 -->
  </div>
@include('partials.footer')