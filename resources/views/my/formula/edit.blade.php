@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa dịch vụ @else Thêm mới dịch vụ @endif
@endsection
@section('menu3')
active
@endsection
@section('content')
<main class="site-main">
    <section class="site-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 col-md-12">
                    @include('my.layout.sidebar')
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="card border-light mt-5">
                        <div class="card-header">
                            Dịch vụ - @if($id > 0) chỉnh sửa @else đăng bài @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label">Mức giá</label>
                                        
                                        </div>
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label">Mô tả</label>
                                        
                                        </div>
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label">Bắt đầu </label>
                                        
                                        </div>
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label">Kết thúc </label>
                                        
                                        </div>
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label">đơn giá </label>
                                        
                                        </div>
                                        <div class="col-md-2">
                                            <label for="staticFrom" class="col-form-label d-block">Tùy chọn </label>
                                        
                                        </div>
                                    </div>
                                    <div class="wrap-ip">
                                        @if(sizeof($data) > 0)
                                            @foreach($data as $k => $v)

                                            <div class="row mb-2 bl-{{ $k }}">
                                                <div class="col-md-2">
                                                <input type="text" name="data[{{ $k }}][name]" class="form-control" value="{{ $v->name }}" required placeholder="Tên mức">
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="data[{{ $k }}][description]" class="form-control" value="{{ $v->description }}" required placeholder="Mô tả">
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="data[{{ $k }}][start]" class="form-control" value="{{ $v->start }}" required placeholder="Từ">
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="data[{{ $k }}][end]" class="form-control" value="{{ $v->end }}" required placeholder="Đến">
                                                
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="data[{{ $k }}][price]" class="form-control" value="{{ $v->price }}" required placeholder="Giá">
                                                
                                                </div>
                                                <div class="col-md-2">
                                                <a name="" id="" class="btn btn-danger btn-remove" href="javascript:void(0);" data-id="{{ $k }}" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="row">
                                        <a name="" id="" class="btn btn-info btn-add ml-auto" href="javascript:void(0);" role="button">Thêm</a>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-5 col-auto"></div>
                                        <div class="col ml-2">
                                        <a href="{{ route('my.motel.getList') }}" class="btn btn-secondary"><i
                                                    class="far fa-times-circle mr-2"></i>Trở lại</a>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-check mr-2"></i>Đồng ý</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
@section('custom_js')
    <script>
        $(document).ready(function(){
            var count = {{ count($data) }};
            $('.btn-add').click(function(){
                var html = '<div class="row mb-2 bl-'+ count +'">' +
                                '<div class="col-md-2">' +
                                    '<input type="text" name="data['+ count +'][name]" class="form-control" value="" required placeholder="Tên mức">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<input type="text" name="data['+ count +'][description]" class="form-control" value="" required placeholder="Mô tả">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<input type="number" name="data['+ count +'][start]" class="form-control" min="0" value="0" required placeholder="Từ">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<input type="number" name="data['+ count +'][end]" class="form-control" min="0" value="0" required placeholder="Đến">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<input type="number" name="data['+ count +'][price]" class="form-control" min="0" value="0" required placeholder="giá">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<a name="" id="" class="btn btn-danger btn-remove" href="javascript:void(0);" data-id="'+ count +'" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                                '</div>'+
                            '</div>';
                            console.log(html);
                $('.wrap-ip').append(html);
                count++;
            });

            $(this).on('click', '.btn-remove', function(){
                var id = $(this).data('id');
                $('.bl-' + id).remove();
            });
        })
    </script>
@endsection
+