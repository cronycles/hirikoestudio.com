<input
    type="hidden"
    id="{{$field->name}}"
    name="{{$field->name}}"
    class="jfield"
    data-val="{{$field->validations}}"
    value="{{old($field->name, $field->value)}}"
    autocomplete="{{$field->name}}"
    placeholder="&nbsp;">
