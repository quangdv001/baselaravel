{{-- <!DOCTYPE html>
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
</html> --}}

@extends('site.layouts.main')
@section('content')
        @include('site.elements.breadCrumb')
        <div class="section-main">
            <div class="container main-wrapper"> 
                @isset($data)
                <h1 class="page-title"><a href="#">{{ $category->name }}</a></h1>
                @else 
                <h1 class="page-title"><span>404: Trang không tìm thấy</span></h1> 
                @endisset
                <div class="row">
                    <div class="col-sm-9 border-sm-right">
                            @isset($data)
                                @foreach ($data as $item)
                                    @if ($category->name == 'for-rents')
                                        @include('site.elements.forRentListItem', ['item'=>$item, 'category'=>$category])  
                                    @else
                                        @include('site.elements.itemThumbNew', ['item'=>$item, 'category'=>$category])  
                                    @endif
                                @endforeach                                
                                {{-- Releated news --}}
                                @include('site.components.releatedNews')
                                {{-- End Releated news --}}                            
                            @else
                                <div class="text-left" style="padding: 15px;">
                                    Rất tiếc nội dung bạn đang tìm kiếm không tồn tại hoặc bạn không có đủ quyền.
                                </div>
                            @endisset
                    </div>
                    <div class="col-sm-3 sidebar">
                        @include('site.layouts.sidebar')
                    </div> <!-- sidebar -->
                </div>
            </div>
        </div>
        
@endsection