@extends('site.layouts.main')
@section('content')
        @include('site.elements.breadCrumb')
        <div class="section-main">
            <div class="container main-wrapper"> 
                @isset($post)
                <h1 class="page-title"><a href="#">{{ $post->title }}</a></h1>  
                @else 
                <h1 class="page-title"><span>404: Trang không tìm thấy</span></h1> 
                @endisset
                <div class="row">
                    <div class="col-sm-9 border-sm-right">
                            @isset($post)
                                @include('site.components.detailPost', $post)
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