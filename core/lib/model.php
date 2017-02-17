<?php

namespace core\lib;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class model
 * @package core\lib
 */
class model extends MyModel
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