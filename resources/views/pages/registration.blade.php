    @include('partials.header_guest')

    <div class="row">
        <div class="col-md-6">
            <form action="">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Registration</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="email" class="form-control" placeholder="Firstname"  data-key="FirstName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Middlename</label>
                            <input type="email" class="form-control" placeholder="Middlename"  data-key="MiddleName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input type="email" class="form-control" placeholder="Lastname"  data-key="LastName" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Birthdate</label>
                            <input type="date" class="form-control" placeholder=""  data-key="Birthdate" data="req">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="text" class="form-control" placeholder="Contact Number"  data-key="ContactNo" data="req">
                        </div>
                        <div class="form-group">
                            <label for="">Email address</label>
                            <input type="email" class="form-control" placeholder="Enter email"  data-key="Email" data="req">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="Password"  data-key="Password" data="req">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password"  data-key="ConfirmPassword" data="req">
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-between">

                            <button class="btn btn-outline-success" data-trigger="submit">
                                <i class="fas fa-user-plus"></i> Sign-Up
                            </button>

                            <a class="btn btn-outline-danger" href="/">
                                <i class="fa fa-undo"></i> Cancel
                            </a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
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
            </div>
        </div>
    </div>
    @include('partials.footer')
    <script src="{{asset('scripts/modules/registration.js')}}"></script>