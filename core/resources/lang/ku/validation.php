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

    'accepted' => 'دەبێت :attribute پەسەند بکرێت.',
    'accepted_if' => 'دەبێت :attribute پەسەند بکرێت کاتێک :other یەکسانە بە :value.',
    'active_url' => ':attribute بەستەرێکی دروست نییە.',
    'after' => 'دەبێت :attribute بەروارێک بێت دوای :date.',
    'after_or_equal' => 'دەبێت :attribute بەروارێک بێت دوای یان یەکسان بە :date.',
    'alpha' => 'دەبێت :attribute تەنها پیت لەخۆبگرێت.',
    'alpha_dash' => 'دەبێت :attribute تەنها پیت، ژمارە، هێڵ و هێڵەژێر لەخۆبگرێت.',
    'alpha_num' => 'دەبێت :attribute تەنها پیت و ژمارە لەخۆبگرێت.',
    'array' => 'دەبێت :attribute ئەرەی بێت.',
    'before' => 'دەبێت :attribute بەروارێک بێت پێش :date.',
    'before_or_equal' => 'دەبێت :attribute بەروارێک بێت پێش یان یەکسان بە :date.',
    'between' => [
        'array' => 'دەبێت :attribute لە نێوان :min و :max دانەی بێت.',
        'file' => 'دەبێت :attribute لە نێوان :min و :max کیلۆبایت بێت.',
        'numeric' => 'دەبێت :attribute لە نێوان :min و :max بێت.',
        'string' => 'دەبێت :attribute لە نێوان :min و :max پیت بێت.',
    ],
    'boolean' => 'خانەی :attribute دەبێت دروست یان هەڵە بێت.',
    'confirmed' => 'دڵنیابوونی :attribute یەکسان نییە.',
    'current_password' => 'وشەی نهێنی هەڵەیە.',
    'date' => ':attribute بەروارێکی دروست نییە.',
    'date_equals' => 'دەبێت :attribute بەروارێک بێت یەکسان بە :date.',
    'date_format' => ':attribute گونجاو نییە لەگەڵ فۆرماتی :format.',
    'declined' => 'دەبێت :attribute ڕەت بکرێت.',
    'declined_if' => 'دەبێت :attribute ڕەت بکرێت کاتێک :other یەکسانە بە :value.',
    'different' => 'دەبێت :attribute و :other جیاواز بن.',
    'digits' => 'دەبێت :attribute :digits ژمارە بێت.',
    'digits_between' => 'دەبێت :attribute لە نێوان :min و :max ژمارە بێت.',
    'dimensions' => ':attribute ڕەهەندی وێنەی نادروستی هەیە.',
    'distinct' => 'خانەی :attribute نرخێکی دووبارەی هەیە.',
    'doesnt_end_with' => ':attribute نابێت بە یەکێک لەمانە کۆتایی هێنرابێت: :values.',
    'doesnt_start_with' => ':attribute نابێت بە یەکێک لەمانە دەستپێبکات: :values.',
    'email' => 'دەبێت :attribute ئیمەیڵێکی دروست بێت.',
    'ends_with' => 'دەبێت :attribute بە یەکێک لەمانە کۆتایی هێنرابێت: :values.',
    'enum' => ':attribute هەڵبژێردراو نادروستە.',
    'exists' => ':attribute هەڵبژێردراو نادروستە.',
    'file' => 'دەبێت :attribute پەڕگە بێت.',
    'filled' => 'خانەی :attribute دەبێت نرخێکی هەبێت.',
    'gt' => [
        'array' => 'دەبێت :attribute زیاتر لە :value دانەی هەبێت.',
        'file' => 'دەبێت :attribute زیاتر لە :value کیلۆبایت بێت.',
        'numeric' => 'دەبێت :attribute زیاتر لە :value بێت.',
        'string' => 'دەبێت :attribute زیاتر لە :value پیت بێت.',
    ],
    'gte' => [
        'array' => 'دەبێت :attribute :value دانە یان زیاتر هەبێت.',
        'file' => 'دەبێت :attribute زیاتر یان یەکسان بە :value کیلۆبایت بێت.',
        'numeric' => 'دەبێت :attribute زیاتر یان یەکسان بە :value بێت.',
        'string' => 'دەبێت :attribute زیاتر یان یەکسان بە :value پیت بێت.',
    ],
    'image' => 'دەبێت :attribute وێنە بێت.',
    'in' => ':attribute هەڵبژێردراو نادروستە.',
    'in_array' => 'خانەی :attribute لە :other بوونی نییە.',
    'integer' => 'دەبێت :attribute ژمارەی تەواو بێت.',
    'ip' => 'دەبێت :attribute ناونیشانی IP ـێکی دروست بێت.',
    'ipv4' => 'دەبێت :attribute ناونیشانی IPv4 ـێکی دروست بێت.',
    'ipv6' => 'دەبێت :attribute ناونیشانی IPv6 ـێکی دروست بێت.',
    'json' => 'دەبێت :attribute رشته‌ـی JSON ـێکی دروست بێت.',
    'lt' => [
        'array' => 'دەبێت :attribute کەمتر لە :value دانەی هەبێت.',
        'file' => 'دەبێت :attribute کەمتر لە :value کیلۆبایت بێت.',
        'numeric' => 'دەبێت :attribute کەمتر لە :value بێت.',
        'string' => 'دەبێت :attribute کەمتر لە :value پیت بێت.',
    ],
    'lte' => [
        'array' => 'دەبێت :attribute زیاتر نەبێت لە :value دانە.',
        'file' => 'دەبێت :attribute کەمتر یان یەکسان بە :value کیلۆبایت بێت.',
        'numeric' => 'دەبێت :attribute کەمتر یان یەکسان بە :value بێت.',
        'string' => 'دەبێت :attribute کەمتر یان یەکسان بە :value پیت بێت.',
    ],
    'mac_address' => 'دەبێت :attribute ناونیشانی MAC ـێکی دروست بێت.',
    'max' => [
        'array' => ':attribute نابێت زیاتر لە :max دانە هەبێت.',
        'file' => ':attribute نابێت زیاتر بێت لە :max کیلۆبایت.',
        'numeric' => ':attribute نابێت زیاتر بێت لە :max.',
        'string' => ':attribute نابێت زیاتر بێت لە :max پیت.',
    ],
    'mimes' => ':attribute دەبێت پەڕگەی جۆری :values بێت.',
    'mimetypes' => ':attribute دەبێت پەڕگەی جۆری :values بێت.',
    'min' => [
        'array' => ':attribute دەبێت بەلایەنی کەمەوە :min دانە هەبێت.',
        'file' => ':attribute دەبێت بەلایەنی کەمەوە :min کیلۆبایت بێت.',
        'numeric' => ':attribute دەبێت بەلایەنی کەمەوە :min بێت.',
        'string' => ':attribute دەبێت بەلایەنی کەمەوە :min پیت بێت.',
    ],
    'multiple_of' => ':attribute دەبێت چەندێکی :value بێت.',
    'not_in' => ':attribute هەڵبژێردراو نادروستە.',
    'not_regex' => 'فۆرماتی :attribute نادروستە.',
    'numeric' => ':attribute دەبێت ژمارە بێت.',
    'password' => [
        'letters' => ':attribute دەبێت بەلایەنی کەمەوە یەک پیت لەخۆبگرێت.',
        'mixed' => ':attribute دەبێت یەک پیتی گەورە و یەک پیتی بچووک لەخۆبگرێت.',
        'numbers' => ':attribute دەبێت بەلایەنی کەمەوە یەک ژمارە لەخۆبگرێت.',
        'symbols' => ':attribute دەبێت بەلایەنی کەمەوە یەک هێمای تایبەتی لەخۆبگرێت.',
        'uncompromised' => 'ئەو :attribute ـە لە داتا لیککەدا دەرکەوتووە. تکایە :attribute ـی تر هەڵبژێرە.',
    ],
    'present' => 'خانەی :attribute دەبێت بوونی هەبێت.',
    'prohibited' => 'خانەی :attribute قەدەغەیە.',
    'prohibited_if' => 'خانەی :attribute قەدەغەیە کاتێک :other یەکسانە بە :value.',
    'prohibited_unless' => 'خانەی :attribute قەدەغەیە مەگەر :other لە :values بێت.',
    'prohibits' => 'خانەی :attribute قەدەغە دەکات :other بۆ بوون.',
    'regex' => 'فۆرماتی :attribute نادروستە.',
    'required' => 'خانەی :attribute پێویستە.',
    'required_array_keys' => 'خانەی :attribute دەبێت تێدایە بۆ: :values.',
    'required_if' => 'خانەی :attribute پێویستە کاتێک :other یەکسانە بە :value.',
    'required_unless' => 'خانەی :attribute پێویستە مەگەر :other لە :values بێت.',
    'required_with' => 'خانەی :attribute پێویستە کاتێک :values بوونی هەبێت.',
    'required_with_all' => 'خانەی :attribute پێویستە کاتێک :values هەموویان بوونی هەبێت.',
    'required_without' => 'خانەی :attribute پێویستە کاتێک :values بوونی نەبێت.',
    'required_without_all' => 'خانەی :attribute پێویستە کاتێک هیچەک لە :values بوونی نەبێت.',
    'same' => ':attribute و :other دەبێت یەکسان بن.',
    'size' => [
        'array' => ':attribute دەبێت :size دانە لەخۆبگرێت.',
        'file' => ':attribute دەبێت :size کیلۆبایت بێت.',
        'numeric' => ':attribute دەبێت :size بێت.',
        'string' => ':attribute دەبێت :size پیت بێت.',
    ],
    'starts_with' => ':attribute دەبێت دەستپێبکات بە یەکێک لەمانە: :values.',
    'string' => ':attribute دەبێت رشته بێت.',
    'timezone' => ':attribute دەبێت ناوچەکاتی دروست بێت.',
    'unique' => ':attribute پێشتر وەرگیراوە.',
    'uploaded' => 'بارکردنی :attribute شکستی هێنا.',
    'url' => ':attribute دەبێت URL ـێکی دروست بێت.',
    'uuid' => ':attribute دەبێت UUID ـێکی دروست بێت.',

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
            'rule-name' => 'پیامی تایبەتی خۆت',
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
