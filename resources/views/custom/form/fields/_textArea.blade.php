<textarea
    id="{{$field->name}}"
    name="{{$field->name}}"
    class="jfield @error($field->name) form__field--error @enderror"
    data-val="{{$field->validations}}"
    autocomplete="{{$field->name}}"
    placeholder="" rows="{{$field->rows}}">{{old($field->name, $field->value)}}</textarea>
