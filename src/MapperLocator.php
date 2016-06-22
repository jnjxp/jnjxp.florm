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
 * @category  Locator
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm;

/**
 * MapperLocator
 *
 * @category Locator
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see MapperLocatorInterface
 */
class MapperLocator implements MapperLocatorInterface
{

    /**
     * Factories for mappers
     *
     * @var array[callable]
     *
     * @access protected
     */
    protected $factories = [];

    /**
     * Mappers
     *
     * @var array[MapperInterface]
     *
     * @access protected
     */
    protected $mappers = [];


    /**
     * Locator has mapper?
     *
     * @param string $mapper name
     *
     * @return bool
     *
     * @access public
     */
    public function has($mapper)
    {
        return isset($this->factories[$mapper]);
    }

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
    public function get($mapper)
    {
        if (! $this->has($mapper)) {
            throw new Exception("$mapper not found");
        }

        if (! isset($this->mappers[$mapper])) {
            $factory = $this->factories[$mapper];
            $this->mappers[$mapper] = $factory();
        }

        return $this->mappers[$mapper];
    }

    /**
     * Set a mapper factory
     *
     * @param mixed    $mapper  name
     * @param callable $factory to create a mapper
     *
     * @return void
     *
     * @access public
     */
    public function set($mapper, callable $factory)
    {
        $this->factories[$mapper] = $factory;
    }
}
