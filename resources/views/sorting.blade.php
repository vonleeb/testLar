@section('sorting')
    <p>
    <form name="sortForm" action="/" method="get">
        <select name="sorting" onchange="document.forms['sortForm'].submit()">
            <option value="">select sort</option>
            @foreach($sorting as $name => $field)
                @foreach(\App\Http\Helpers\SortHelper::ALLOWED_ORDER as $order)
                    <option @if(\App\Http\Helpers\SortHelper::$sorting == $field . '+' . $order) selected @endif
                            value="{{ $field . '+' . $order }}">{{ $name . ' ' . $order }}</option>
                @endforeach
            @endforeach
        </select>
    </form>
    </p>
@show