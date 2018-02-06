<?php

/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */
//Autoloader::add_core_namespace('');

Autoloader::add_classes(array(
    'Spreadsheet_Excel_Reader' => __DIR__ . '/classes/excel_reader2.php'
));


/* End of file bootstrap.php */
