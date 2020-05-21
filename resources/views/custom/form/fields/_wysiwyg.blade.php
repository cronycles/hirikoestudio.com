<input
    type="hidden"
    id="{{$field->name}}"
    name="{{$field->name}}"
    class="jfield jwysiwygInput"
    data-val="{{$field->validations}}"
    value="{!! old($field->name, $field->value) !!}">

<div id="jww_{{$field->name}}" data-name="{{$field->name}}" class="jfieldSub jwysiwyg form__content-editable @error($field->name) form__field--error @enderror">
    {!! old($field->name, $field->value) !!}
</div>





