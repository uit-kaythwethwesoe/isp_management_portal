<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Users</title>
  </head>
  <body>
    <table class="table-bordered">                                
        <thead>
            <tr>
                <th>{{ __('#') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Register phone') }}</th>
                <th>{{ __('Password') }}</th>
                <th>{{ __('Register date') }}</th>
                <th>{{ __('Account Status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index =>$value)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$value->name}}</td>    
                    <td>{{$value->phone}}</td>
                    {{-- SECURITY: Show masked password instead of plaintext --}}
                    <td>{{ $value->new_pass ? '••••••••' : 'N/A' }}</td>
                    <td>{{date('Y-m-d', strtotime($value->created_at))}}</td>
                    <td>
                        <?php 
                            if($value->user_status == 0)
                            {
                                $status = "<b class='badge badge-warning'>Normal</b>"; 
                            }else
                            {
                                $status = "<b class='badge badge-danger'>Disabled</b>";
                            }
                            echo $status;
                        ?>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>