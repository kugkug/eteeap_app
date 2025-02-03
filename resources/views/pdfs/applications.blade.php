<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <link rel="shortcut icon" href="{{ asset('images/au_logo.png') }}" type="image/x-icon">
    
    <title>ETEEAP</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }
   .table {
        /* Table styles */
        display: table;
        background-color: #fff;
        width: 100%;
    }

.table th {
  /* Table headers styles */
  text-align: left;
  padding: 8px;
  background-color: #f0f0f0;
  border: 1px solid #ddd;
}

.table th, .table td {
  /* Table cells styles */
  text-align: left;
  padding: 8px;
  vertical-align: top;
  border: none;
}

.table td {
  /* Table cells styles */
  word-wrap: break-word;
}

.table-striped td:nth-child(odd) {
  /* Table stripes styles */
  background-color: #f9f9f9;
}

.table-bordered th, .table-bordered td {
  /* Table border styles */
  border: 1px solid #ddd;
}
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Desired Course</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $applicant)
                    <tr>
                        <td>{{ ucwords(strtolower( $applicant['lastname'] ." ".$applicant['firstname'] .", ".$applicant['middlename'])) }}</td>
                        <td>{{ $applicant['desired_course'] }} </td>
                        <td>{{ $applicant['email'] }} </td>
                        <td>{{ $applicant['phone'] }} </td>
                        <td>{{ $applicant['status'] }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
