<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' <strong>:attribute</strong> tiene que ser confirmado.',
    'active_url' => ' <strong>:attribute</strong> no es un URL v&agrave;lido.',
    'after' => ' <strong>:attribute</strong> tiene que ser una fecha posterior que :date.',
    'after_or_equal' => '<strong>:attribute</strong> tiene que ser una fecha posterior o igual que :date.',
    'alpha' => ' <strong>:attribute</strong> puede solo contener letras.',
    'alpha_dash' => ' <strong>:attribute</strong> puede solo contener letras, numeros y guiones.',
    'alpha_num' => ' <strong>:attribute</strong> puede solo contener letras y numeros.',
    'array' => " <strong>:attribute</strong> tiene que ser un array.",
    'before' => ' <strong>:attribute</strong> tiene que ser una fecha inferior que :date.',
    'before_or_equal' => '<strong>:attribute</strong> tiene que ser una fecha inferior o igual que :date.',
    'between' => [
        'numeric' => '<strong>:attribute</strong> tiene que ser incluido entre :min y :max.',
        'file' => '<strong>:attribute</strong> tiene que ser incluido entre :min y :max kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que ser incluido entre :min y :max caracteres.',
        'array' => '<strong>:attribute</strong> deve avere elementi compresi tra :min y :max .',
    ],
    'boolean' => 'El campo <strong>:attribute</strong> tiene que ser verdadero o falso.',
    'confirmed' => 'El campo <strong>:attribute</strong> confirmaci&oacute; no corresponde.',
    'date' => '<strong>:attribute</strong> no es una fecha valida.',
    'date_equals'          => '<strong>:attribute</strong> tiene que ser una fecha igual que :date.',
    'date_format' => '<strong>:attribute</strong> no corresponde al formato :format.',
    'different' => '<strong>:attribute</strong> y :other tienen que ser diferentes.',
    'digits' => '<strong>:attribute</strong> tiene que ser de :digits numeros.',
    'digits_between' => '<strong>:attribute</strong> tiene que ser incluido entre :min y :max numeros.',
    'dimensions' => '<strong>:attribute</strong> es una imagen de dimensiones no validas.',
    'distinct' => '<strong>:attribute</strong> tiene un valor duplicado.',
    'email' => '<strong>:attribute</strong> no es un correo electronico v&agrave;lido.',
    'ends_with' => '<strong>:attribute</strong> tiene que acabar con uno de los siguientes valores: :values',
    'exists' => "el <strong>:attribute</strong> selecionado no es v&agrave;lido.",
    'filled' => '<strong>:attribute</strong> es obligatorio.',
    'gt' => [
        'numeric' => '<strong>:attribute</strong> tiene que tener un valor mas alto que :value.',
        'file' => '<strong>:attribute</strong> tiene que tener un valor mas alto que :value kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que tener un valor mas alto que :value characteres.',
        'array' => '<strong>:attribute</strong> tiene que tener mas de :value valores.',
    ],
    'gte' => [
        'numeric' => '<strong>:attribute</strong> tiene que tener un valor igual o mas alto que :value.',
        'file' => '<strong>:attribute</strong> tiene que tener un valor igual o mas alto que :value kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que tener un valor igual o mas alto que :value characteres.',
        'array' => '<strong>:attribute</strong> tiene que tener un numero de valore igual o mas alto que :value.',
    ],
    'image' => '<strong>:attribute</strong> tiene que ser una imagen.',
    'in' => "el campo selecionado <strong>:attribute</strong> no es v&agrave;lido.",
    'in_array' => '<strong>:attribute</strong> no existe en :other.',
    'integer' => '<strong>:attribute</strong> tiene que ser entero.',
    'ip' => '<strong>:attribute</strong> tiene que ser ua valida direcci&oacute; IP.',
    'ipv4' => '<strong>:attribute</strong> tiene que ser ua valida direcci&oacute; IPv4.',
    'ipv6' => '<strong>:attribute</strong> tiene que ser ua valida direcci&oacute; IPv6.',
    'json' => '<strong>:attribute</strong> tiene que ser una valida estringa JSON.',
    'lt' => [
        'numeric' => '<strong>:attribute</strong> tiene que tener un valor mas bajo que :value.',
        'file' => '<strong>:attribute</strong> tiene que tener un valor mas bajo que :value kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que tener un valor mas bajo que :value caratteri.',
        'array' => '<strong>:attribute</strong> tiene que tener menos de :value valores.',
    ],
    'lte' => [
        'numeric' => '<strong>:attribute</strong> tiene que tener un valor igual o mas bajo que :value.',
        'file' => '<strong>:attribute</strong> tiene que tener un valor igual o mas bajo que :value kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que tener un valor igual o mas bajo que :value caratteri.',
        'array' => '<strong>:attribute</strong> tiene que tener un numero de valores igual o mas bajo que :value.',
    ],
    'max' => [
        'numeric' => '<strong>:attribute</strong> no puede ser mas grande de :max.',
        'file' => '<strong>:attribute</strong> no puede ser mas grande de :max kilobytes.',
        'string' => '<strong>:attribute</strong> no puede ser mas grande de :max caracteres.',
        'array' => '<strong>:attribute</strong> no puede ser aver mas de :max elementos.',
    ],
    'mimes' => '<strong>:attribute</strong> tiene que ser un fichero de tipo :values.',
    'mimetypes' => '<strong>:attribute</strong> tiene que ser un fichero de tipo :values.',
    'min' => [
        'numeric' => '<strong>:attribute</strong> tiene que ser almeno de :min.',
        'file' => '<strong>:attribute</strong> tiene que ser almeno de :min kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que ser almeno de :min caracteres.',
        'array' => '<strong>:attribute</strong> tiene que tener almeno :min elementos.',
    ],
    'not_in' => "El campo seleccionado <strong>:attribute</strong> no es v&agrave;lido.",
    'not_regex' => 'El formato del campo seleccionado <strong>:attribute</strong> non es v&agrave;lido.',
    'numeric' => '<strong>:attribute</strong> tiene que ser un numero.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo <strong>:attribute</strong> tiene que ser presente.',
    'price'=> 'El campo <strong>:attribute</strong> tiene que ser un precio válido.',
    'regex' => '<strong>:attribute</strong> el formato no es v&agrave;lido.',
    'required' => 'El campo <strong>:attribute</strong> es requerido.',
    'required_if' => 'El campo <strong>:attribute</strong> es requerido cuando :other vale :value.',
    'required_unless' => 'El campo <strong>:attribute</strong> es requerido hasta que :other vale :value.',
    'required_with' => 'El campo <strong>:attribute</strong> es requerido cuando :values est&aacute; presente.',
    'required_with_all' => 'El campo <strong>:attribute</strong> es requerido cuando :values est&aacute; presente.',
    'required_without' => 'El campo <strong>:attribute</strong> es requerido cuando :values no est&aacute; presente.',
    'required_without_all' => 'El campo <strong>:attribute</strong> es requerido cuando nunguno de estos :values est&aacute; presente.',
    'same' => '<strong>:attribute</strong> and :other must match.',
    'size' => [
        'numeric' => '<strong>:attribute</strong> tiene que ser :size.',
        'file' => '<strong>:attribute</strong> tiene que ser :size kilobytes.',
        'string' => '<strong>:attribute</strong> tiene que ser :size caracteres.',
        'array' => '<strong>:attribute</strong> tiene que contener :size elementos.',
    ],
    'starts_with' => '<strong>:attribute</strong> tiene que empezar con uno de los siguientes valores: :values',
    'string' => '<strong>:attribute</strong> tiene que ser una estringa.',
    'timezone' => '<strong>:attribute</strong> tiene que ser una timezone valida.',
    'unique' => '<strong>:attribute</strong> ya ha sido elegido.',
    'uploaded' => '<strong>:attribute</strong> ha fallido el upload.',
    'url' => 'El formato <strong>:attribute</strong> no es v&agrave;lido.',
    'uuid' => '<strong>:attribute</strong> tiene que ser un UUID v&agrave;lido.',
    'generic_error' => 'Ha occurrido un error enviando los datos.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        //        'images.*' => [
        //            'max' => 'la imagen no puede ser mas grande que :max KB',
        //        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'zeroValueKey' => 'Elige...',
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'textMsg' => 'Mensaje',
        'password' => 'Contraseña',
        'password_confirm' => 'Repite la contraseña',
        'remember' => 'Recuerdame',
        'title' => 'Título',
        'description' => 'Descripción',
        'price' => 'Precio',
        'date' => 'Fecha',
        'show-in-home' => 'Muestra en la página de inicio',
        'show' => 'Visible',
    ],

];
