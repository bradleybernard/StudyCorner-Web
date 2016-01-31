<?php

return array(

    'StudyCorner'     => array(
        'environment' => 'development',
        'certificate' => base_path() . env('CERT_PATH'),
        'passPhrase'  => env('CERT_PASS'),
        'service'     => 'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'yourAPIKey',
        'service'     =>'gcm'
    )

);
