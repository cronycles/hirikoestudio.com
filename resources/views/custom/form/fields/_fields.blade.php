<div class="form__inputs">
    @if($fields != null && !empty($fields))
        @foreach($fields as $field)
            <div class="form__row">
                @if($field->type == config('custom.form.field-types.PRICE'))
                    <label for="{{$field->name}}">{{$field->text}} (€)</label>
                @else
                    <label for="{{$field->name}}">{{$field->text}}</label>
                @endif
                @switch($field->type)
                    @case(config('custom.form.field-types.TEXT'))
                        @include('custom.form.fields._text', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.TEXT_AREA'))
                        @include('custom.form.fields._textArea', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.WYSIWYG'))
                        @include('custom.form.fields._wysiwyg', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.EMAIL'))
                        @include('custom.form.fields._email', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.PASSWORD'))
                        @include('custom.form.fields._password', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.CHECKBOX'))
                        @include('custom.form.fields._checkbox', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.CHECKBOX_ARRAY'))
                        @include('custom.form.fields._checkbox-array', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.SELECTBOX'))
                        @include('custom.form.fields._selectbox', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.PRICE'))
                        @include('custom.form.fields._price', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.DATE'))
                        @include('custom.form.fields._date', ['field' => $field])
                    @break
                    @case(config('custom.form.field-types.HIDDEN'))
                        @include('custom.form.fields._hidden', ['field' => $field])
                    @break
                @endswitch

                <div class="form__field--error-text-container">
                    <p class="jerrText form__field--error-text none animated" data-f="{{$field->name}}" role="alert">
                        {{$field->errorText}}
                    </p>
                </div>

            </div>
        @endforeach
    @endif
</div>
