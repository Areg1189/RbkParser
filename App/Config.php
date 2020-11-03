<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{
    /**
     * Database driver
     * @var string
     */
    const DB_DRIVER = "mysql";

    /**
     * Database host
     * @var string
     */
    const DB_HOST = "localhost";

    /**
     * Database name
     * @var string
     */
    const DB_NAME = "dbName";

    /**
     * Database user
     * @var string
     */
    const DB_USER = "root";

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = "kfkI#nGb0m2L";

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * Путь до папки с шаблонами
     * @var string
     */
    const VIEWS_BASEDIR = '../App/Views/';
}
