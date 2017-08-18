<?php


return [

    // Specify the directory where you want to save all web sites
    // this is the shared folder

    'ApplicationRootFolder' => 'C:\\KPA_www\\',

    'RemoteEngineApi' => 'http://69.4.84.226:21001/',

    'SSLEnable' => ["status" => false],

    'CName' => 'cname.scrapcatapp.com',

    // you can set unlimited host name
    // all hostnames will be used as freely by your customers
    // Note: all hostnames should point to main server ip address. Where the CPANELV21 and IIS are Installed or Located.

    'IIS_Hosts' => [ 'scrapcatapp.com', 's  crapcatapp.com', 'scrapcatapp.com' ],

    // mysql connection for your database clients
    // Note: your hostname or ip address for MySQL Connection. Should setup to main server. Where the CPANELV21 and MySQL are Installed or Located.

    'MySQL_Hosts' => [
        'hostname' => 'mysql-connection.scrapcatapp.com',
        'ip_address' => '69.4.84.226',
    ],

    // ftp connection for you ftp clients
    // Note: hostname or ip address can be setup in different server.
    // The hostname or IP address should be set up where the CPANELV21.Engine is Installed or Located.

    'FTP_Hosts' => [
        'hostname' => 'ftp-connection.scrapcatapp.com',
        'ip_address' => '69.4.84.226',
    ],

];


