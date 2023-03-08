<?php
return [
        'url' => 'https://vpic.nhtsa.dot.gov/api/vehicles',
    'format' => 'json',
    'methods' => [
            'decode' => 'DecodeVin',
            'model' => 'getmodelsformakeid',
            'marks' => 'getallmakes'
    ]
];