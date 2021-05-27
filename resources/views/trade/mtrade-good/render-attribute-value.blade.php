<table class="table table-bordered table-sm w-100">
    @foreach($attr_values as $k => $val)
        <tr>
            <td>{{ $val[0]->mTradeAttribute->name }}</td>
            <td>
                @foreach($val as $i => $v)
                    <div class="form-check form-check-inline my-custom-radio">
                        <input class="form-check-input"
                               type="radio"
                               name="attribute_{{$v->mtrade_attribute_id}}"
                               id="inlineRadio{{$v->id}}" value="{{$v->id}}"
                               required
                        >
                        <label class="form-check-label btn btn-sm btn-outline-primary"
                               for="inlineRadio{{$v->id}}">{{$v->value}}</label>
                    </div>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>
