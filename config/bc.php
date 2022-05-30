<?php
return [
    'active_theme'=>env('BC_DEFAULT_THEME','base'),
    "media"=>[
        "groups"=>[
            "default"=>[
                "ext"=>["jpg",'jpeg','png','gif','bmp'],
                "mime"=>["image/png","image/jpeg","image/gif","image/bmp"],
                "max_size"=>20000000, // In Bytes, default is 20MB,
                "max_width"=>env('ALLOW_IMAGE_MAX_WIDTH',2500),
                "max_height"=>env('ALLOW_IMAGE_MAX_HEIGHT',2500)
            ],
            "image"=>[
                "ext"=>["jpg",'jpeg','png','gif','bmp'],
                "mime"=>["image/png","image/jpeg","image/gif","image/bmp"],
                "max_size"=>20000000, // In Bytes, default is 20MB,
                "max_width"=>env('ALLOW_IMAGE_MAX_WIDTH',2500),
                "max_height"=>env('ALLOW_IMAGE_MAX_HEIGHT',2500)
            ],
            'cvs'=>[
                "ext"=>['ppt','pptx','pdf','docx','doc'],
                "mime"=>["application/vnd.ms-powerpoint","application/vnd.openxmlformats-officedocument.presentationml.presentation","application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword"],
                "max_size" => 50000000,
            ],
            'scorm' => [
                "ext"=>['zip','rar', 'gzip'],
                "mime"=> ['application/x-gzip', 'application/zip', 'application/x-rar-compressed'],
                "max_size" => 200000000 // In Bytes, default is 200MB,
            ],
            'order_attachment' => [
                "ext"=>["jpg",'jpeg','png','gif','bmp','zip','rar', 'gzip'],
                "mime"=>["image/png","image/jpeg","image/gif","image/bmp",'application/x-gzip', 'application/zip', 'application/x-rar-compressed'],
                "max_size"=>200000000,
                "max_width"=>env('ALLOW_IMAGE_MAX_WIDTH',2500),
                "max_height"=>env('ALLOW_IMAGE_MAX_HEIGHT',2500)
            ]
        ],
        "optimize_image"=>env('BC_MEDIA_OPTIMIZE_IMAGE',true),
        "preview_direct"=>env("BC_MEDIA_PREVIEW_DIRECT",true)
    ],
    'email'=>[
        "css_files"=>[
        ]
    ],
    'disable_require_password'=>env('DISABLE_REQUIRE_CHANGE_PW',0),
    'demo_mode'=>env('DEMO_MODE',0),
    'app_https'=>env('APP_HTTPS',0),
    'cf_enable_image_resize'=>env('CF_ENABLE_IMAGE_RESIZE'),
    'resize_simple'=>env('APP_RESIZE_SIMPLE'),
    'preview_media_link'=>env('APP_PREVIEW_MEDIA_LINK')
];
