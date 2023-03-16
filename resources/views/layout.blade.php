<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" >

    <title>Employee Management</title>
  </head>
  <body>
    {{View::make("header")}}
    @yield('content')
    {{-- {{View::make("footer")}} --}}

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
  <style>
    .custom-login{
        height: 500px;
        padding-top: 100px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" ></script>

  <script src="{{ asset('js/app.js') }}"></script>
</html>