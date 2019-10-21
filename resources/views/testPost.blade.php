<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <button class="test">Click me!</button>
    <div class="content"></div>
    <script src="{{ asset('assets/frontend/libs/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/notyv2/jquery.noty.packaged.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/admin/js/init.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.test').click(function(){
                console.log(1);
                var data = {name: 'test name', note: 'test note', deposits: 1000, duration : 50, payment_period: 1000, start: 1571668690, end: 1571668990, status: 1, user_id: 20, rent_id: 1};
                var url = BASE_URL + '/my/contract/create';
                $.post(url, data, function(res){
                    $('.content').html(res.data);
                })
            })
        })
    </script>
</body>
</html>