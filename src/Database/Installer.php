<?php
/**
 * 2007-2020 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0).
 * It is also available through the world-wide-web at this URL: https://opensource.org/licenses/AFL-3.0
 */
declare(strict_types=1);

namespace DarkSide\DsOmnibus\Database;

use Context;
use Db;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Statement;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * We cannot use Doctrine entities on install because the mapping is not available yet
 * but we can still use Doctrine connection to perform DQL or SQL queries.
 */
class Installer
{
    /**
     * @var string
     */
    private string $dbPrefix = _DB_PREFIX_;

    /**
     * @var array
     */
    private const TABLES = [
        'gprd_cookie.sql',
        'gprd_cookie_lang.sql',
        'gprd_cookie_category.sql',
        'gprd_cookie_category_lang.sql',
        'gprd_cookie_field.sql',
        'gprd_cookie_field_lang.sql',
        'gprd_cookie_gui_configuration.sql',
        'gprd_cookie_gui_configuration_value.sql',
        'alters.sql',
        'default_data.sql'
    ];

    private $translator;

    /**
     * @var string
     */
    private const PATH = '/../../Resources/data/';

    /**
     * @param Connection $connection
     * @param string $dbPrefix
     */
    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    private function getTables()
    {
        return self::TABLES;
    }

    private function getPath()
    {
        return self::PATH;
    }

    /**
     * @return array
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function createTables()
    {
        $errors = [];
        
        $this->dropTables();

        $sqlQueries = $this->getInstallSqlQueries(); 
        
        foreach ($sqlQueries as $query) {
            if (empty($query)) {
                continue;
            }
            
            $executeErrors  = $this->setExecutionStatement($query);
            $errors[] = $executeErrors;
        }

        return $errors;
    }

    /**
     * @return array
     */
    private function getInstallSqlQueries(): array
    {
        $sqlQueries = [];
        $tables = $this->getTables();
        $path = $this->getPath();

        foreach($tables as $table) {
            $filePath = __DIR__ . $path . $table;
            $sqlQuery = file_get_contents($filePath);

            if ($sqlQuery === false) {
                $message = $this->translator->trans('Cant\'t find a queryies in the file: ' . $table);

                $controller = Context::controller();
                $controller->warnings[] = $message;
            }

            $sqlQuery = str_replace('PREFIX_', $this->dbPrefix, $sqlQuery);

            $sqlQueries[] = $sqlQuery;

        }

        return $sqlQueries;
    }

    /**
     * @return array
     *
     * @throws DBALException
     */
    public function dropTables()
    {
        $errors = [];
        $sqlQueries = $this->getDropSqlQueries();

        foreach ($sqlQueries as $query) {
            $error = $this->setExecutionStatement($query);

            $errors[] = $error;
        }

        return $errors;
    }

    /**
     * @return array
     */
    private function getDropSqlQueries(): array
    {
        $sqlQueries = [];
        $tables = $this->getTables();

        foreach ($tables as $table) { 
            $tableName = $this->getFileNameWithoutExtension($table);

            $sql = 'DROP TABLE IF EXISTS ' . $this->dbPrefix . $tableName;

            $sqlQueries[] = $sql;
        }

        return $sqlQueries;
    }

    /**
     * @param string $table
     * 
     * @return string
     */
    private function getFileNameWithoutExtension(string $table): string {
        $path = $this->getPath();
        $fullFileName = $table;
        $filePath = __DIR__ . $path . $fullFileName;

        $fileInfo = pathinfo($filePath);
        $fileNameWithoutExtension = $fileInfo['filename'];

        return $fileNameWithoutExtension;
    }

    /**
     * @param string $sql
     * 
     * @return array
     */
    private function setExecutionStatement(string $sql): array
    {
        $errors = [];

        $erros[] = Db::getInstance()->execute($sql);

        return $errors;
    }
}
