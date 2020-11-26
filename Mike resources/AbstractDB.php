<?php
declare(strict_types = 1);

abstract class AbstractDB 
{
	abstract function  __construct( string $host, string $dbUser, string $dbPass, string $dbName );
}