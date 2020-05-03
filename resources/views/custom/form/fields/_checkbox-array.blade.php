@foreach($field->items as $item)
    <input type="checkbox"
           name="{{$field->name.'[]'}}"
           class="jfield @error($field->name) form__field--error @enderror"
           data-val="{{$field->validations}}"
           {{$field->value === true ? 'checked' : ''}}
           {{(is_array(old($field->name)) and in_array(1, old($field->name))) ? ' checked' : '' }}
           value="1">
    {{$item->name}}
@endforeach
