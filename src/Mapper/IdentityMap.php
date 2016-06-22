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

use Jnjxp\Florm\Exception;

/**
 * IdentityMap
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see IdentityMapInterface
 */
class IdentityMap implements IdentityMapInterface
{
    /**
     * Map of entities
     *
     * @var array
     *
     * @access protected
     */
    protected $map = [];

    /**
     * Has the entity id been mapped?
     *
     * @param string $identity of entity
     *
     * @return bool
     *
     * @access public
     */
    public function has($identity)
    {
        return isset($this->map[$identity]);
    }

    /**
     * Set an entity in the map
     *
     * @param string $identity of the entity
     * @param mixed  $entity   to map
     *
     * @return void
     *
     * @access public
     */
    public function set($identity, $entity)
    {
        $this->map[$identity] = $entity;
    }

    /**
     * Get an entity from the map
     *
     * @param string $identity to get
     *
     * @return mixed
     *
     * @access public
     */
    public function get($identity)
    {
        if (! $this->has($identity)) {
            throw new Exception("Identity [$identity] not mapped");
        }
        return $this->map[$identity];
    }
}
