<input name="{{$field->name}}" type="hidden" value="0">
<input type="checkbox"
       id="{{$field->name}}"
       name="{{$field->name}}"
       class="jfield @error($field->name) form__field--error @enderror"
       data-val="{{$field->validations}}"
       {{$field->value === true ? 'checked' : ''}}
       {{old($field->name) ? 'checked': ''}}
       value="1">
