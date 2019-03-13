@extends('admin.layout.main')
@section('title')
    Danh sách tài khoản
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách tài khoản</h4>
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
                                        Tài khoản
                                    </th>
                                    <th>
                                        Họ tên
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        SĐT
                                    </th>
                                    <th>
                                        Trạng thái
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
                                            {{ $v->username }}
                                        </td>
                                        <td>
                                            {{ $v->name }}
                                        </td>
                                        <td>
                                            {{ $v->email }}
                                        </td>
                                        <td>
                                            {{ $v->phone }}
                                        </td>
                                        <td class="text-center">
                                            @if($v->active == 1)
                                                <span class="text-success"><i class="fa fa-user-plus icon-sm" aria-hidden="true"></i></span>
                                            @else
                                                <span class="text-danger"><i class="fa fa-user-times icon-sm" aria-hidden="true"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.account.getCreate', ['id' => $v->id]) }}" class="text-warning"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>
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
