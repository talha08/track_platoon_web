<?php

return array(

    'appNameIOS'     => array(
        'environment' =>'development',
        'certificate' =>'/path/to/certificate.pem',
        'passPhrase'  =>'password',
        'service'     =>'apns'
    ),
    'appNameAndroid' => array(
        'environment' =>'production',
        'apiKey'      =>'AIzaSyBnrDUzPJvFsotpBjnJR3eVIk6D2b6LfwY',
        'service'     =>'gcm'
    )

);