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
 * @category  Data
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm\Data;

/**
 * Gateway to data
 *
 * @category Data
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see GatewayInterface
 */
class Gateway implements GatewayInterface
{
    /**
     * Data Reader
     *
     * @var ReaderInterface
     *
     * @access protected
     */
    protected $reader;

    /**
     * Entity type
     *
     * @var string
     *
     * @access protected
     */
    protected $type;

    /**
     * Record class
     *
     * @var string
     *
     * @access protected
     */
    protected $record = Record::class;

    /**
     * Create a data gateway
     *
     * @param ReaderInterface $reader of data
     * @param string          $type   of data to access
     *
     * @access public
     */
    public function __construct(ReaderInterface $reader, $type)
    {
        $this->reader = $reader;
        $this->type   = $type;
    }

    /**
     * Get an index of all records
     *
     * @return array
     *
     * @access public
     */
    public function index()
    {
        return $this->reader->index($this->type);
    }

    /**
     * Read a record
     *
     * @param string $identity of record to read
     *
     * @return RecordInterface
     *
     * @access public
     */
    public function read($identity)
    {
        $record = $this->record;
        $data   = $this->reader->read($this->type, $identity);
        $data[$this->type . 'Id'] = $identity;
        return new $record($data);
    }
}
