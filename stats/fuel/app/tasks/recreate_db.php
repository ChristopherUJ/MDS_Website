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
 * Description of Recreate_db
 *
 * @author David Weber
 */
class Recreate_db {

    public static function run() {
        $db_name = 'mdsolvesselstats';

        // Drop database
        try {
            \Fuel\Core\DBUtil::drop_database($db_name);
            \Fuel\Core\Cli::write('Successfully dropped database.', 'green');
        } catch (\Fuel\Core\Database_Exception $ex) {
            \Fuel\Core\Cli::error($ex->getMessage());
        }

        // Create database
        try {
            \Fuel\Core\DBUtil::create_database($db_name);
            \Fuel\Core\Cli::write('Successfully created database.', 'green');
        } catch (\Fuel\Core\Database_Exception $ex) {
            \Fuel\Core\Cli::error($ex->getMessage());
        }

        // Install next
        \Fuel\Core\Cli::write('php oil refine install', 'blue');
        // Migrate next
        \Fuel\Core\Cli::write('php oil refine migrate', 'blue');

        @chmod(DOCROOT . DS . 'assets' . DS . 'datasets', 0777);
    }

}

?>
