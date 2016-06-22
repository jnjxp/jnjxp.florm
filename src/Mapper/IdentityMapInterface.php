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
 * @package   Code
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm\Mapper;

/**
 * IdentityMapInterface
 *
 * @category Interface
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see IdentityMapInterface
 */
interface IdentityMapInterface
{

    /**
     * Has the entity id been mapped?
     *
     * @param string $identity of entity
     *
     * @return bool
     *
     * @access public
     */
    public function has($identity);

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
    public function set($identity, $entity);

    /**
     * Get an entity from the map
     *
     * @param string $identity to get
     *
     * @return mixed
     *
     * @access public
     */
    public function get($identity);
}
