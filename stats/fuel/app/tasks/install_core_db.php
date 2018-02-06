<?php

/**
 * DCS Core is the core collection of packages for Dark Continent Solutions
 * 
 * @package    DCS Core
 * @version    1.0
 * @author     Dark Continent Solutions
 * @license    Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported
 * @copyright  2010 - 2011 Dark Continent Solutions
 * @link       http://www.darkcontinentsolutions.co.za
 */

namespace Fuel\Tasks;

/**
 * Description of Install_core_data
 *
 * @author David Weber
 */
class Install_core_db {

    public static function run() {
        \Fuel\Core\Cli::write('Task - Install Core DB: Started', 'white');
        $core_data = \Fuel\Core\File::read(APPPATH . 'sql' . DS . 'core_data.sql', true);
        $insert_array = explode(';', $core_data);
        \Fuel\Core\DB::start_transaction();
        try {
            foreach ($insert_array as $insert_statement) {
                if (trim($insert_statement) != '') {
                    $result = \Fuel\Core\DB::query($insert_statement, \Fuel\Core\DB::INSERT)->execute();
                    if (!$result) {
                        throw new \Fuel\Core\Database_Exception('Failed to execute INSERT query');
                    }
                }
            }
            \Fuel\Core\DB::commit_transaction();
            \Fuel\Core\Cli::write('Task - Install Core DB: Successfully completed', 'green');
        } catch (\Fuel\Core\Database_Exception $ex) {
            \Fuel\Core\DB::rollback_transaction();
            \Fuel\Core\Cli::error('Task - Install Core DB: Database Exception: ' . $ex->getMessage() . ' Statement: ' . $insert_statement);
        }
    }

}

?>
