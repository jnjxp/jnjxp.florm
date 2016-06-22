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

namespace Jnjxp\Florm\Data\Fs;

/**
 * Reader
 *
 * @category Interfacee
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see ReaderInterface
 */
interface ReaderInterface
{
    /**
     * Get identities of all records
     *
     * @param string $type of record for which to get index
     *
     * @return array
     *
     * @access public
     */
    public function index($type);

    /**
     * Read a record
     *
     * @param string $type     of record to read
     * @param string $identity of record to read
     *
     * @return array
     *
     * @access public
     */
    public function read($type, $identity);
}
