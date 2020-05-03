<input type="number"
       name="{{$field->name}}"
       value="{{old($field->name, $field->value)}}"
       class="jfield @error($field->name) form__field--error @enderror"
       data-val="{{$field->validations}}"
       min="0.00"
       placeholder=" "
       max="100000.00"
       step="any" />

