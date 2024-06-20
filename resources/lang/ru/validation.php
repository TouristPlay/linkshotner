<?php

return [
    'accepted' => 'Атрибут :attribute должен быть принят.',
    'active_url' => ':attribute не является допустимым URL-адресом.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равной :date.',
    'alpha' => 'Атрибут :attribute может содержать только буквы.',
    'alpha_dash' => 'Атрибут :attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num' => 'Атрибут :attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой, предшествующей :date.',
    'before_or_equal' => 'Атрибут :attribute должен быть датой, предшествующей :date или равной ей.',
    'between' => [
        'numeric' => 'Значение :attribute должно находиться в диапазоне от :min до :max.',
        'file' => 'Размер :attribute должен находиться в диапазоне от :min до :max килобайт.',
        'string' => 'Значение :attribute должно находиться между символами :min и :max.',
        'array' => 'В :attribute должно быть от :min до :max элементов.',
    ],
    'boolean' => 'Поле :attribute должно иметь значение true или false.',
    'confirmed' => 'Подтверждение :attribute не соответствует.',
    'date' => ':attribute не является допустимой датой.',
    'date_equals' => 'В поле :attribute должна быть дата, равная :date.',
    'date_format' => 'Атрибут :attribute не соответствует формату :format.',
    'different' => 'Параметры :attribute и :other должны быть разными.',
    'digits' => 'Атрибут :attribute должен быть :digits числом.',
    'digits_between' => 'Значение :attribute должно находиться в диапазоне от :min до :max цифр.',
    'dimensions' => 'У :attribute недопустимые размеры изображения.',
    'distinct' => 'Поле :attribute имеет повторяющееся значение.',
    'email' => 'Атрибут :attribute должен быть действительным адресом электронной почты.',
    'ends_with' => 'Атрибут :attribute должен заканчиваться одним из следующих символов: :values.',
    'exists' => 'Выбранный :attribute недействителен.',
    'file' => 'Атрибут :attribute должен быть файлом.',
    'filled' => 'Поле :attribute должно иметь значение.',
    'gt' => [
        'numeric' => 'Значение :attribute должно быть больше, чем :value.',
        'file' => 'Значение :attribute должно быть больше :value в килобайтах.',
        'string' => 'Значение :attribute должно быть больше символов :value.',
        'array' => 'В :attribute должно быть более :value элементов.',
    ],
    'gte' => [
        'numeric' => 'Атрибут :attribute должен быть больше или равен :value.',
        'file' => 'Значение :attribute должно быть больше или равно :value в килобайтах.',
        'string' => 'Значение :attribute должно быть больше или равно :value символов.',
        'array' => 'В атрибуте :attribute должно быть или более элементов :value.',
    ],
    'image' => 'Атрибут :attribute должен быть изображением.',
    'in' => 'Выбранный :attribute недействителен.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => 'Атрибут :attribute должен быть целым числом.',
    'ip' => ':attribute должен быть действительным IP-адресом.',
    'ipv4' => 'Атрибут :attribute должен быть действительным IPv4-адресом.',
    'ipv6' => 'Атрибут :attribute должен быть действительным IPv6-адресом.',
    'json' => 'Атрибут :attribute должен быть допустимой строкой JSON.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'Значение :attribute должно быть меньше :value.',
        'file' => 'Размер :attribute должен быть меньше :value в килобайтах.',
        'string' => 'Значение :attribute должно быть меньше символов :value.',
        'array' => 'В :attribute должно быть меньше :value элементов.',
    ],
    'max' => [
        'numeric' => 'Значение :attribute не может быть больше :max.',
        'file' => 'Размер :attribute не может превышать :max килобайт.',
        'string' => 'Размер :attribute не может превышать :max символов.',
        'array' => 'В :attribute не может быть более :max элементов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => 'Значение :attribute должно быть не менее :min.',
        'file' => 'Размер :attribute должен быть не менее :min килобайт.',
        'string' => 'В поле :attribute должно быть не менее :min символов.',
        'array' => 'В :attribute должно быть не менее :min элементов.',
    ],
    'multiple_of' => 'Атрибут :attribute должен быть кратен :value',
    'not_in' => 'Выбранный :attribute недействителен.',
    'not_regex' => 'Формат :attribute недействителен.',
    'numeric' => 'Атрибут :attribute должен быть числом.',
    'password' => 'Пароль неверен.',
    'present' => 'Поле :attribute должно присутствовать.',
    'regex' => 'Формат :attribute недействителен.',
    'required' => 'Поле :attribute является обязательным.',
    'required_if' => 'Поле :attribute является обязательным, если :other равно :value.',
    'required_unless' => 'Поле :attribute является обязательным, если только :other не находится в :values.',
    'required_with' => 'Поле :attribute является обязательным, если присутствует :values.',
    'required_with_all' => 'Поле :attribute является обязательным, если присутствуют :values.',
    'required_without' => 'Поле :attribute является обязательным, если :values ​​отсутствует.',
    'required_without_all' => 'Поле :attribute является обязательным, если ни одно из :values ​​не присутствует.',
    'same' => 'Параметры :attribute и :other должны совпадать.',
    'size' => [
        'numeric' => 'Атрибут :attribute должен быть :size.',
        'file' => 'Значение :attribute должно быть :size в килобайтах.',
        'string' => 'В поле :attribute должны быть символы :size.',
        'array' => ':attribute должен содержать элементы :size.',
    ],
    'starts_with' => 'Атрибут :attribute должен начинаться с одного из следующих символов: :values.',
    'string' => 'Атрибут :attribute должен быть строкой.',
    'timezone' => 'Атрибут :attribute должен быть допустимым поясом.',
    'unique' => 'Атрибут :attribute уже занят.',
    'uploaded' => 'Не удалось загрузить :attribute.',
    'url' => 'Формат :attribute недействителен.',
    'uuid' => 'Атрибут :attribute должен быть допустимым UUID.',

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
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
