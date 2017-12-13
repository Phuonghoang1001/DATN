<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>English Online</title>
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/import/sidebar.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
@include('layout.header')
<div class="main-wrapper">
    @yield('content')
</div>
@include('layout.footer')
</body>
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/admin.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $('#btn-practive').click(function (){
            $('.lesson-practice').toggle();
        });
    });
</script>
</html>