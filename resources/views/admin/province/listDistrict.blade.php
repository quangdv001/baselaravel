@extends('admin.layout.main')
@section('title')
    Danh sách quận huyện
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách quận huyện</h4>
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
                                        Tên quận huyện
                                    </th>
                                    <th>
                                        District Id
                                    </th>
                                    <th>
                                        Province Id
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
                                            {{ $v->name }}
                                        </td>
                                        <td>
                                            {{ $v->district_id }}
                                        </td>
                                        <td>
                                            {{ $v->province_id }}
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
