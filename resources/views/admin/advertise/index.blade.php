@extends('admin.layout.main')
@section('title')
Danh sách quảng cáo
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách quảng cáo</h4>
                {{--<p class="card-description">--}}
                {{--Add class--}}
                {{--<code>.table-bordered</code>--}}
                {{--</p>--}}
                <div class="table-responsive">
                    @if($data)
                    <table class="table table-bordered myTable">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Ảnh
                                </th>
                                <th>
                                    Tên
                                </th>
                                <th>
                                    Trạng thái
                                </th>
                                <th>
                                    Từ
                                </th>
                                <th>
                                    Đến
                                </th>
                                <th>
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $v)
                            <tr>
                                <td>
                                    {{ $v->id }}
                                </td>
                                <td>
                                    <img class="img-show" style="width:60px !important; height:60px !important; border-radius:0 !important;"  src="{{ $v->img }}" />
                                </td>
                                <td>
                                    {{ $v->name }}
                                </td>
                                <td class="text-center">
                                    @if($v->status == 1)
                                    <span class="text-success"><i class="fa fa-check icon-sm"
                                            aria-hidden="true"></i></span>
                                    @else
                                    <span class="text-danger"><i class="fa fa-times icon-sm"
                                            aria-hidden="true"></i></span>
                                    @endif
                                </td>
                                <td>
                                    {{ date('d/m/Y', $v->start_time) }}
                                </td>
                                <td>
                                    {{ date('d/m/Y', $v->end_time) }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.advertise.getCreate', ['id' => $v->id]) }}"
                                        class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                            aria-hidden="true"></i></a>
                                    <a href="{{ route('admin.advertise.remove', ['id' => $v->id]) }}"
                                        class="text-danger"><i class="fa fa-trash-o icon-sm"
                                            aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
