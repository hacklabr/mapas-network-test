<?php
$parsed_base_url = parse_url(env('BASE_URL', ''));

$host = $parsed_base_url['host'];
$network_config = [
        'nodeSlug' => str_replace('.', '', $host),
        'filters' => [
            'agent' => [],
            'space' => []
        ],
        'nodes' => [

        ],
        // usar os formatos relativos (https://www.php.net/manual/pt_BR/datetime.formats.relative.php)
        'nodes-verification-interval' => '1 week'
    ];

switch($host) {
    case 'nacional.integrador.testes.map.as':
        $network_config['nodeSlug'] = str_replace('.', '', 'nacional.integrador.testes.map.as');
        $network_config['nodes'] = ['https://sp.integrador.testes.map.as/', 'https://sc.integrador.testes.map.as/'];
        break;

    case 'sc.integrador.testes.map.as':
        $network_config['nodeSlug'] =  str_replace('.', '', 'sc.integrador.testes.map.as');
        $network_config['filters']['agent']['En_Estado'] = 'SC';
        $network_config['filters']['space']['En_Estado'] = 'SC';
        $network_config['nodes'] = ['https://nacional.integrador.testes.map.as/'];
        break;

    case 'sp.integrador.testes.map.as':
        $network_config['nodeSlug'] =  str_replace('.', '', 'sp.integrador.testes.map.as');
        $network_config['filters']['agent']['En_Estado'] = 'SP';
        $network_config['filters']['space']['En_Estado'] = 'SP';
        $network_config['nodes'] = ['https://nacional.integrador.testes.map.as/', 'https://sampa.integrador.testes.map.as/'];
        break;

    case 'sampa.integrador.testes.map.as':
        $network_config['nodeSlug'] =  str_replace('.', '', 'sampa.integrador.testes.map.as');
        $network_config['filters']['agent']['En_Estado'] = 'SP';
        $network_config['filters']['space']['En_Estado'] = 'SP';
        $network_config['filters']['agent']['En_Municipio'] = 'São Paulo';
        $network_config['filters']['space']['En_Municipio'] = 'São Paulo';
        $network_config['nodes'] = ['https://sp.integrador.testes.map.as/', 'https://nacional.integrador.testes.map.as/'];
        break;
}
return [
    'plugins' => [
        'EvaluationMethodTechnical' => ['namespace' => 'EvaluationMethodTechnical', 'config' => ['step' => 0.1]],
        'EvaluationMethodSimple' => ['namespace' => 'EvaluationMethodSimple'],
        'EvaluationMethodDocumentary' => ['namespace' => 'EvaluationMethodDocumentary'],

        'MultipleLocalAuth' => [ 'namespace' => 'MultipleLocalAuth' ],
        
        'MapasNetwork' => [
            'namespace' => 'MapasNetwork',
            'config' => $network_config
        ]
    ]
];