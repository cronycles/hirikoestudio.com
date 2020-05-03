<input
    type="text"
    id="{{$field->name}}"
    name="{{$field->name}}"
    class="jfield @error($field->name) form__field--error @enderror"
    data-val="{{$field->validations}}"
    value="{{old($field->name, $field->value)}}"
    autocomplete="{{$field->name}}"
    placeholder="&nbsp;">
