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

namespace Jnjxp\Florm;

/**
 * MapperLocatorInterface
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @interface
 */
interface MapperLocatorInterface
{
    /**
     * Locator has maper?
     *
     * @param string $mapper name
     *
     * @return bool
     *
     * @access public
     */
    public function has($mapper);

    /**
     * Get a mapper
     *
     * @param string $mapper name
     *
     * @return MapperInterface
     * @throws Exception if mapper not found
     *
     * @access public
     */
    public function get($mapper);

    /**
     * Set a mapper factory
     *
     * @param string   $mapper  name
     * @param callable $factory to create a mapper
     *
     * @return void
     *
     * @access public
     */
    public function set($mapper, callable $factory);
}
