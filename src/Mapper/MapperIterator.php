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
 * @category  Mapper
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm\Mapper;

use Jnjxp\Florm\MapperInterface;

use Iterator;

/**
 * Mapper Iterator
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see Iterator
 */
class MapperIterator implements Iterator
{
    /**
     * Mapper
     *
     * @var MapperInterface
     *
     * @access protected
     */
    protected $mapper;

    /**
     * Position of iteration
     *
     * @var int
     *
     * @access protected
     */
    protected $position = 0;

    /**
     * Index of entity ids
     *
     * @var array[string]
     *
     * @access protected
     */
    protected $index = [];

    /**
     * Iterate over all entries the mapper can read
     *
     * @param MapperInterface $mapper the mapper to iterate
     *
     * @access public
     */
    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
        $this->index  = $mapper->index();
    }

    /**
     * Rewind iterator
     *
     * @return void
     *
     * @access public
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Current iteration
     *
     * @return mixed
     *
     * @access public
     */
    public function current()
    {
        $key = $this->index[$this->position];
        return $this->maper->get($key);
    }

    /**
     * Key of iteration
     *
     * @return string
     *
     * @access public
     */
    public function key()
    {
        return $this->index[$this->position];
    }

    /**
     * Next iteration
     *
     * @return void
     *
     * @access public
     */
    public function next()
    {
        ++ $this->position;
    }

    /**
     * Valid iteration
     *
     * @return bool
     *
     * @access public
     */
    public function valid()
    {
        return isset($this->index[$this->position]);
    }
}
