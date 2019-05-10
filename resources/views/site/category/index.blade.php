<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if(sizeof($data) > 0)
    <ul>
    
    @foreach($data as $v)
    <li><a href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">{{$v->title}}</a></li>
    @endforeach
    </ul>
    @endif
</body>
</html>
