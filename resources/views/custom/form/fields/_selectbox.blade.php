<select
    id="{{$field->name}}"
    name="{{$field->name}}"
    class="jfield @error($field->name) form__field--error @enderror"
    data-val="{{$field->validations}}">
    <option value>{{$field->zeroValueText}}</option>
    @foreach($field->items as $item)
        <option value="{{$item->value}}" {{$item->value == $field->selectedId ? 'selected' : ''}} {{old($field->name) == $item->value ? 'selected' : ''}} >
            {{$item->name}}
        </option>
    @endforeach
</select>
