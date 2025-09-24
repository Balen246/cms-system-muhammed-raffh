<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'مثبّت نظام Smartend',
    'next' => 'الخطوة التالية',
    'back' => 'السابق',
    'finish' => 'تثبيت',
    'forms' => [
        'errorTitle' => 'حدثت الأخطاء التالية:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'مرحبًا',
        'title'   => 'مثبّت نظام Smartend',
        'message' => 'معالج إعداد وتثبيت سهل.',
        'next'    => 'تحقق من المتطلبات',
    ],

    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'الخطوة 1 | متطلبات الخادم',
        'title' => 'متطلبات الخادم',
        'next'    => 'تحقق من الأذونات',
    ],

    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'الخطوة 2 | الأذونات',
        'title' => 'الأذونات',
        'next' => 'تهيئة بيئة العمل',
    ],

    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'menu' => [
            'templateTitle' => 'الخطوة 3 | إعدادات البيئة',
            'title' => 'إعدادات البيئة',
            'desc' => 'يرجى اختيار كيفية تهيئة ملف <code>.env</code> للتطبيق.',
            'wizard-button' => 'إعداد عبر المعالج',
            'classic-button' => 'محرّر نصي تقليدي',
        ],
        'wizard' => [
            'templateTitle' => 'الخطوة 3 | إعدادات البيئة | معالج موجّه',
            'title' => 'معالج <code>.env</code> الموجّه',
            'tabs' => [
                'environment' => 'البيئة',
                'database' => 'قاعدة البيانات',
                'application' => 'التطبيق'
            ],
            'form' => [
                'name_required' => 'اسم البيئة مطلوب.',
                'app_name_label' => 'اسم التطبيق',
                'app_name_placeholder' => 'اسم التطبيق',
                'app_environment_label' => 'بيئة التطبيق',
                'app_environment_label_local' => 'محلي',
                'app_environment_label_developement' => 'تطوير',
                'app_environment_label_qa' => 'اختبار جودة',
                'app_environment_label_production' => 'تشغيل',
                'app_environment_label_other' => 'أخرى',
                'app_environment_placeholder_other' => 'أدخل بيئتك...',
                'app_debug_label' => 'تصحيح الأخطاء',
                'app_debug_label_true' => 'مفعّل',
                'app_debug_label_false' => 'معطّل',
                'app_log_level_label' => 'مستوى سجل التطبيق',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => 'رابط التطبيق',
                'app_url_placeholder' => 'رابط التطبيق',
                'db_connection_label' => 'اتصال قاعدة البيانات',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
                'db_host_label' => 'مضيف قاعدة البيانات',
                'db_host_placeholder' => 'مضيف قاعدة البيانات',
                'db_port_label' => 'منفذ قاعدة البيانات',
                'db_port_placeholder' => 'منفذ قاعدة البيانات',
                'db_name_label' => 'اسم قاعدة البيانات',
                'db_name_placeholder' => 'اسم قاعدة البيانات',
                'db_username_label' => 'مستخدم قاعدة البيانات',
                'db_username_placeholder' => 'مستخدم قاعدة البيانات',
                'db_password_label' => 'كلمة مرور قاعدة البيانات',
                'db_password_placeholder' => 'كلمة مرور قاعدة البيانات',

                'app_tabs' => [
                    'more_info' => 'مزيد من المعلومات',
                    'broadcasting_title' => 'البث، التخزين المؤقت، الجلسات والطوابير',
                    'broadcasting_label' => 'محرك البث',
                    'broadcasting_placeholder' => 'محرك البث',
                    'cache_label' => 'محرك الكاش',
                    'cache_placeholder' => 'محرك الكاش',
                    'session_label' => 'محرك الجلسة',
                    'session_placeholder' => 'محرك الجلسة',
                    'queue_label' => 'محرك الطابور',
                    'queue_placeholder' => 'محرك الطابور',
                    'redis_label' => 'Redis',
                    'redis_host' => 'مضيف Redis',
                    'redis_password' => 'كلمة مرور Redis',
                    'redis_port' => 'منفذ Redis',

                    'mail_label' => 'البريد',
                    'mail_driver_label' => 'محرك البريد',
                    'mail_driver_placeholder' => 'محرك البريد',
                    'mail_host_label' => 'مضيف البريد',
                    'mail_host_placeholder' => 'مضيف البريد',
                    'mail_port_label' => 'منفذ البريد',
                    'mail_port_placeholder' => 'منفذ البريد',
                    'mail_username_label' => 'اسم مستخدم البريد',
                    'mail_username_placeholder' => 'اسم مستخدم البريد',
                    'mail_password_label' => 'كلمة مرور البريد',
                    'mail_password_placeholder' => 'كلمة مرور البريد',
                    'mail_encryption_label' => 'تشفير البريد',
                    'mail_encryption_placeholder' => 'تشفير البريد',

                    'pusher_label' => 'Pusher',
                    'pusher_app_id_label' => 'معرّف تطبيق Pusher',
                    'pusher_app_id_palceholder' => 'معرّف تطبيق Pusher',
                    'pusher_app_key_label' => 'مفتاح تطبيق Pusher',
                    'pusher_app_key_palceholder' => 'مفتاح تطبيق Pusher',
                    'pusher_app_secret_label' => 'سرّ تطبيق Pusher',
                    'pusher_app_secret_palceholder' => 'سرّ تطبيق Pusher',
                ],
                'buttons' => [
                    'setup_database' => 'إعداد قاعدة البيانات',
                    'setup_application' => 'إعداد التطبيق',
                    'install' => 'تثبيت',
                ],
                'db_connection_failed' => 'فشل الاتصال بقاعدة البيانات، تحقق من بيانات الاتصال.',
            ],
        ],
        'classic' => [
            'templateTitle' => 'الخطوة 3 | إعدادات البيئة | المحرّر التقليدي',
            'title' => 'محرّر البيئة التقليدي',
            'save' => 'حفظ .env',
            'back' => 'استخدم معالج النماذج',
            'install' => 'حفظ وتثبيت',
        ],
        'success' => 'تم حفظ إعدادات ملف .env بنجاح.',
        'errors' => 'تعذّر حفظ ملف .env، يرجى إنشاؤه يدويًا.',
    ],

    'install' => 'تثبيت',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'تم تثبيت مثبّت Laravel بنجاح بتاريخ ',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'اكتمل التثبيت',
        'templateTitle' => 'اكتمل التثبيت',
        'finished' => 'تم تثبيت Smartend بنجاح.',
        'migration' => 'مخرجات الهجرة &amp; الزرع:',
        'console' => 'مخرجات وحدة تحكم التطبيق:',
        'log' => 'سجل التثبيت:',
        'env' => 'ملف .env النهائي:',
        'exit' => 'الانتقال إلى لوحة تحكم Smartend',
    ],

    /**
     *
     * Update specific translations
     *
     */
    'updater' => [
        /**
         *
         * Shared translations.
         *
         */
        'title' => 'محدّث Laravel',

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title'   => 'مرحبًا بك في المحدّث',
            'message' => 'مرحبًا بك في معالج التحديث.',
        ],

        /**
         *
         * Overview page translations for update feature.
         *
         */
        'overview' => [
            'title'   => 'نظرة عامة',
            'message' => 'هناك تحديث واحد.|هناك :number تحديثات.',
            'install_updates' => 'تثبيت التحديثات'
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => 'انتهى',
            'finished' => 'تم تحديث قاعدة بيانات التطبيق بنجاح.',
            'exit' => 'انقر هنا للذهاب إلى لوحة الإدارة',
        ],

        'log' => [
            'success_message' => 'تم تحديث مثبّت Laravel بنجاح بتاريخ ',
        ],
    ],

];
