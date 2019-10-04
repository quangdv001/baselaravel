@extends('admin.layout.main')
@section('title')
Quản lý liên kết
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if($data)
                    <table class="table table-bordered myTable1">
                        <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Liên Kết
                                </th>
                                <th>
                                    Nội dung
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
                                    {{ $v->code }}
                                </td>
                                <td>
                                    {{ isset($v->value) ? $v->value : 'Chưa có liên kết'  }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.footerSocial.getCreate', ['id' => $v->id]) }}"
                                        class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                            aria-hidden="true"></i></a>
                                    -
                                    <a href="{{ route('admin.footerSocial.remove', ['id' => $v->id]) }}"
                                        class="text-warning"><i class="fa fa-trash-o icon-sm"
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
