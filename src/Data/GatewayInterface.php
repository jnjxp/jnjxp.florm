<?php
/**
 * Jnjxp\Florm - Flat File ORM
 *
 * PHP version 5
 *
 * Copyright (C) 2016 Jake Johns
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 *
 * @category  Interface
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm\Data;

/**
 * Interface for data gateway
 *
 * @category Interface
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @interface
 */
interface GatewayInterface
{
    /**
     * Index all available records
     *
     * @return array
     *
     * @access public
     */
    public function index();

    /**
     * Read a record
     *
     * @param string $identity of record to read
     *
     * @return RecordInterface
     *
     * @access public
     */
    public function read($identity);
}
