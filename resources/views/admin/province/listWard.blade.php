@extends('admin.layout.main')
@section('title')
    Danh sách phường xã
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách phường xã</h4>
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
                                        Tên phường xã
                                    </th>
                                    <th>
                                        Ward Id
                                    </th>
                                    <th>
                                        District Id
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
                                            {{ $v->ward_id }}
                                        </td>
                                        <td>
                                            {{ $v->district_id }}
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
