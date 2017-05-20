<?php


return [

    // Specify the directory where you want to save all web sites
    // this is the shared folder

    'ApplicationRootFolder' => 'C:\\KPA_www\\',

    'CName' => 'cname.lesterdigital.com', // 'cname.lesterdigital.com',

    // you can set unlimited host name
    // all hostnames will be used as freely by your customers
    // Note: all hostnames should point to main server ip address. Where the CPANELV21 and IIS are Installed or Located.

    'IIS_Hosts' => [ 'lesterdigital.com' ],

    // mysql connection for your database clients
    // Note: your hostname or ip address for MySQL Connection. Should setup to main server. Where the CPANELV21 and MySQL are Installed or Located.

    'MySQL_Hosts' => [
        'hostname' => 'mysql-connection.kpa21.com',
        'ip_address' => '127.0.0.1',
    ],

    // ftp connection for you ftp clients
    // Note: hostname or ip address can be setup in different server.
    // The hostname or IP address should be set up where the CPANELV21.Engine is Installed or Located.

    'FTP_Hosts' => [
        'hostname' => 'ftp-connection.kpa21.com',
        'ip_address' => '127.0.0.1',
    ],

];


