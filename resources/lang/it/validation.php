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

    'accepted' => '<strong>:attribute</strong> deve essere accettato.',
    'active_url' => '<strong>:attribute</strong> non &egrave; un URL valido.',
    'after' => '<strong>:attribute</strong> deve essere una data successiva a :date.',
    'after_or_equal' => '<strong>:attribute</strong> deve essere una data successiva o uguale a :date.',
    'alpha' => '<strong>:attribute</strong> pu&ograve; solo contenere lettere.',
    'alpha_dash' => '<strong>:attribute</strong> pu&ograve; solo contenere lettere, numeri, e trattini.',
    'alpha_num' => '<strong>:attribute</strong> &ograve; solo contenere lettere e numeri.',
    'array' => "<strong>:attribute</strong> deve essere un array.",
    'before' => '<strong>:attribute</strong> deve essere una data inferiore a :date.',
    'before_or_equal' => '<strong>:attribute</strong> deve essere una data inferiore o uguale a :date.',
    'between' => [
        'numeric' => '<strong>:attribute</strong> deve essere compreso tra :min e :max.',
        'file' => '<strong>:attribute</strong> deve essere compreso tra :min e :max kilobytes.',
        'string' => '<strong>:attribute</strong> deve essere compreso tra :min e :max caratteri.',
        'array' => '<strong>:attribute</strong> deve avere elementi compresi tra :min e :max .',
    ],
    'boolean' => 'Il campo <strong>:attribute</strong> deve essere vero o falso.',
    'confirmed' => 'Il campo <strong>:attribute</strong> conferma non corrisponde.',
    'date' => '<strong>:attribute</strong> non &egrave; una data valida.',
    'date_equals'  => '<strong>:attribute</strong> deve essere una data uguale a :date.',
    'date_format' => '<strong>:attribute</strong> non corrisponde al formato :format.',
    'different' => '<strong>:attribute</strong> e :other devono essere differenti.',
    'digits' => '<strong>:attribute</strong> deve essere di :digits numeri.',
    'digits_between' => '<strong>:attribute</strong> deve essere compreso tra :min e :max numeri.',
    'dimensions' => '<strong>:attribute</strong> &egrave; un\'immagine di dimensioni invalide.',
    'distinct' => '<strong>:attribute</strong> ha un valore duplicato.',
    'email' => '<strong>:attribute</strong> deve essere un indirizzo email valido.',
    'ends_with' => '<strong>:attribute</strong> deve terminare con una deo dei seguenti valori: :values',
    'exists' => '<strong>:attribute</strong> non &egrave; valido.',
    'file' => '<strong>:attribute</strong> deve essere un file.',
    'filled' => '<strong>:attribute</strong> deve avere un valore.',
    'gt' => [
        'numeric' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; alto di :value.',
        'file' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; alto di :value kilobytes.',
        'string' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; alto di :value caratteri.',
        'array' => '<strong>:attribute</strong> deve avere pi&ugrave; di :value valori.',
    ],
    'gte' => [
        'numeric' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; alto di :value.',
        'file' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; alto di :value kilobytes.',
        'string' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; alto di :value caratteri.',
        'array' => '<strong>:attribute</strong> deve avere un numero di valori uguali o superiori a :value.',
    ],
    'image' => '<strong>:attribute</strong> deve essere una immagine.',
    'in' => "l'attributo selezionato <strong>:attribute</strong> non &egrave; valido.",
    'in_array' => '<strong>:attribute</strong> non esiste in :other.',
    'integer' => '<strong>:attribute</strong> deve essere un intero.',
    'ip' => '<strong>:attribute</strong> deve essere  un valido indirizzo IP.',
    'ipv4' => '<strong>:attribute</strong> deve essere  un valido indirizzo IPv4.',
    'ipv6' => '<strong>:attribute</strong> deve essere  un valido indirizzo IPv6.',
    'json' => '<strong>:attribute</strong> deve essere  una valida stringa JSON.',
    'lt' => [
        'numeric' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; basso di :value.',
        'file' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; basso di :value kilobytes.',
        'string' => '<strong>:attribute</strong> deve avere un valore pi&ugrave; basso di :value caratteri.',
        'array' => '<strong>:attribute</strong> deve avere meno di :value valori.',
    ],
    'lte' => [
        'numeric' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; basso di :value.',
        'file' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; basso di :value kilobytes.',
        'string' => '<strong>:attribute</strong> deve avere un valore uguale o pi&ugrave; basso di :value caratteri.',
        'array' => '<strong>:attribute</strong> deve avere un numero di valori uguali o inferiori a :value.',
    ],
    'max' => [
        'numeric' => '<strong>:attribute</strong> non pu&ograve; essere pi&ugrave; grande di :max.',
        'file' => '<strong>:attribute</strong> non pu&ograve; essere pi&ugrave; grande di :max kilobytes.',
        'string' => '<strong>:attribute</strong> non pu&ograve; essere pi&ugrave; grande di :max caratteri.',
        'array' => '<strong>:attribute</strong> non pu&ograve; avere pi&ugrave; di :max elementi.',
    ],
    'mimes' => '<strong>:attribute</strong> deve essere un file di tipo: :values.',
    'mimetypes' => '<strong>:attribute</strong> deve essere un file di tipo: :values.',
    'min' => [
        'numeric' => '<strong>:attribute</strong> deve essere almeno :min.',
        'file' => '<strong>:attribute</strong> deve essere almeno :min kilobytes.',
        'string' => '<strong>:attribute</strong> deve essere almeno :min caratteri.',
        'array' => '<strong>:attribute</strong> deve avere almeno :min elementi.',
    ],
    'not_in' => "L'attributo selezionato <strong>:attribute</strong> non &egrave; valido.",
    'not_regex' => 'il formato del campo <strong>:attribute</strong> non &egrave; valido.',
    'numeric' => '<strong>:attribute</strong> deve essere un numero.',
    'password' => 'La password &egrave; incorretta.',
    'present' => 'Il campo <strong>:attribute</strong> deve essere presente.',
    'price'=> 'Il campo <strong>:attribute</strong> dev\'essere un prezzo valido.',
    'regex' => '<strong>:attribute</strong> il formato non &egrave; valido.',
    'required' => 'Il campo <strong>:attribute</strong> &egrave; richiesto.',
    'required_if' => 'Il campo <strong>:attribute</strong> &egrave; richiesto quando :other &egrave; :value.',
    'required_unless' => 'Il campo <strong>:attribute</strong> &egrave; richiesto finch&egrave; :other &egrave :value.',
    'required_with' => 'Il campo <strong>:attribute</strong> &egrave; richiesto quando :values &egrave; presente.',
    'required_with_all' => 'Il campo <strong>:attribute</strong> &egrave; richiesto quando :values &egrave; presente.',
    'required_without' => 'Il campo <strong>:attribute</strong> &egrave; richiesto quando :values non &egrave; presente.',
    'required_without_all' => 'Il campo <strong>:attribute</strong> &egrave; richiesto quando nessuno di questi :values &egrave; presente.',
    'same' => '<strong>:attribute</strong> and :other must match.',
    'size' => [
        'numeric' => '<strong>:attribute</strong> deve essere di :size.',
        'file' => '<strong>:attribute</strong> deve essere di :size kilobytes.',
        'string' => '<strong>:attribute</strong> deve essere di :size caratteri.',
        'array' => '<strong>:attribute</strong> deve contenere :size elementi.',
    ],
    'starts_with' => '<strong>:attribute</strong> deve inziare con uno dei seguenti valori: :values',
    'string' => '<strong>:attribute</strong> deve essere una stringa.',
    'timezone' => '<strong>:attribute</strong> deve essere una timezone valido.',
    'unique' => '<strong>:attribute</strong> &egrave; gi&agrave; stato scelto.',
    'uploaded' => '<strong>:attribute</strong> ha fallito l\'upload.',
    'url' => 'il formato del campo <strong>:attribute</strong> non &egrave; valido.',
    'uuid' => '<strong>:attribute</strong> deve essere un UUID valido.',
    'generic_error' => 'C\'è stato un errore nell\'invio del formulario.',

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
//            'max' => 'l\'immagine non puo essere pi&ugrave; grande di :max KB',
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
        'zeroValueKey' => 'Scegli...',
        'name' => 'Nome',
        'email' => 'Email',
        'textMsg' => 'Messaggio',
        'password' => 'Password',
        'password_confirm' => 'Ripeti la password',
        'remember' => 'Ricordami',
        'title' => 'Titolo',
        'description' => 'Descrizione',
        'price' => 'Prezzo',
        'date' => 'Data',
        'show-in-home' => 'Mostra nella homepage',
        'show' => 'Visibile',
    ],

];
