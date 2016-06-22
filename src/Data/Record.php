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

use ArrayIterator;
use IteratorAggregate;

/**
 * Data Record
 *
 * @category Data
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see IteratorAggregate
 * @see ArrayAccess
 * @see Countable
 */
class Record implements RecordInterface, IteratorAggregate
{
    /**
     * Data
     *
     * @var mixed
     *
     * @access protected
     */
    protected $data = [];

    /**
     * Create a data record object
     *
     * @param array $array of read data
     *
     * @access public
     */
    public function __construct(array $array)
    {
        foreach ($array as $key => $value) {
            $this->data[$key] = is_array($value)
                ? new static($value)
                : $value;
        }
    }

    /**
     * Has property?
     *
     * @param string $property key
     *
     * @return bool
     *
     * @access public
     */
    public function has($property)
    {
        return isset($this->data[$property]);
    }

    /**
     * Get a property value
     *
     * @param string $property key
     * @param mixed  $default  value to return if key does not exist
     *
     * @return mixed
     *
     * @access public
     */
    public function get($property, $default = null)
    {
        return array_key_exists($property, $data)
            ? $data[$property]
            : $default;
    }

    /**
     * __get
     *
     * @param string $property key
     *
     * @return mixed
     *
     * @access public
     */
    public function __get($property)
    {
        return $this->get($property);
    }

    /**
     * __isset
     *
     * @param string $property key
     *
     * @return bool
     *
     * @access public
     */
    public function __isset($property)
    {
        return $this->has($property);
    }

    /**
     * OffsetExists
     *
     * @param string $key of property
     *
     * @return bool
     *
     * @access public
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * OffsetGet
     *
     * @param string $key of property
     *
     * @return mixed
     *
     * @access public
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * OffsetSet
     *
     * @param string $key   property
     * @param mixed  $value value
     *
     * @return void
     * @throws Exception because Record is immutable
     *
     * @access public
     */
    public function offsetSet($key, $value)
    {
        $key; $value;
        $this->imutable();
    }

    /**
     * OffsetUnset
     *
     * @param string $key property
     *
     * @return void
     * @throws Exception because Record is immutable
     *
     * @access public
     */
    public function offsetUnset($key)
    {
        $key;
        $this->imutable();
    }

    /**
     * Imutable
     *
     * @return void
     * @throws Exception because Record is immutable
     *
     * @access protected
     */
    protected function imutable()
    {
        throw new Exception('Record is imutable');
    }

    /**
     * Count
     *
     * @return int
     *
     * @access public
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * GetIterator
     *
     * @return ArrayIterator
     *
     * @access public
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}
