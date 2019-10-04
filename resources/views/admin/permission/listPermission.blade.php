@if($data)
    @foreach($data as $v)
        <tr>
            <td>
                {{ $v->id }}
            </td>
            <td>
                {{ $v->name }}
            </td>
            <td>
                {{ $v->code }}
            </td>
            <td>
                <a href="javascript:void(0)"
                   class="text-warning edit_permission_btn mr-4"
                   data-id="{{ $v->id }}" data-name="{{ $v->name }}"
                   data-code="{{ $v->code }}">
                    <i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i>
                </a>
                <a href="javascript:void(0)" data-id="{{ $v->id }}" class="text-danger rm_permission_btn">
                    <i class="fa fa-trash icon-sm" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    @endforeach
@endif