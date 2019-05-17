@section('sorting')
    <p>
    <form name="sortForm" action="/" method="get">
        <select name="sorting" onchange="document.forms['sortForm'].submit()">
            <option>select sort</option>
            @foreach($sorting as $name => $field)
                @foreach(['asc', 'desc'] as $order)
                    <option @if(\App\Http\Helpers\SortHelper::$sorting['sort'] == $field &&
                                \App\Http\Helpers\SortHelper::$sorting['order'] == $order) selected @endif
                            value="{{ $field . '+' . $order }}">{{ $name . ' ' . $order }}</option>
                @endforeach
            @endforeach
        </select>
    </form>
    </p>
@show