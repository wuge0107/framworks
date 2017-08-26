<?php

namespace core\lib;

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class model
 * @package core\lib
 */
class model extends medoo
{
    /**
     * model constructor.
     */
    public function __construct()
    {
        $option = conf::get('databases');
        parent::__construct($option);
    }
}
