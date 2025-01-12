<div class="card card-danger card-outline">
    <div class="card-body box-profile">
      {{-- <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/au_logo.png') }}" alt="User profile picture">
      </div> --}}
      
      <h3 class="profile-username text-center">

        {{ ucfirst(strtolower($current_user->firstname)) }}
        {{ ucfirst(strtolower($current_user->middlename)) }}
        {{ ucfirst(strtolower($current_user->lastname)) }}
      </h3>

      <p class="text-muted text-center">{{ $profile['position']}}</p>

    </div>

  </div>
  <!-- /.card -->

  <!-- About Me Box -->
  <div class="card card-danger card-outline">
    <div class="card-header">
      <h3 class="card-title">About Me</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <strong><i class="fas fa-book mr-1"></i> Work Experience</strong>

      <p class="text-muted">
        {{ $profile['position']}} at {{ $profile['company']}}
      </p>

      <hr>

      <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

      <p class="text-muted">
        {{ $profile['address']}}
      </p>

      <hr>

      <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

      <p class="text-muted">
        @if ($profile['skills'] != "")
          
        
        @foreach (explode(",", $profile['skills']) as $skill)
        <span class="tag tag-danger">{{$skill}}</span>
        @endforeach
        @endif
      </p>

      <hr>

      {{-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong> --}}

      {{-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
    </div>
    <!-- /.card-body -->
  </div>