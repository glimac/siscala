<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
//                    'port'     => '1521',
                    'user'     => 'root',
                    'password' => '123',
                    'dbname' => 'siscala',
                    'service' => true,
                    'charset' => 'utf8',
                )
            )
        )
    ),
);

