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
 * @category  Trait
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm;

/**
 * EntityTrait
 *
 * @category Trait
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @trait
 */
trait EntityTrait
{
    /**
     * __get
     *
     * @param mixed $property name
     *
     * @return mixed
     *
     * @access public
     */
    public function __get($property)
    {
        $value = $this->$property;
        if ($value instanceof Mapper\LazyInterface) {
            $resolved = $value();
            $this->$property = $resolved;
        }
        return $resolved;
    }

    /**
     * __isset
     *
     * @param mixed $property name
     *
     * @return mixed
     *
     * @access public
     */
    public function __isset($property)
    {
        return isset($this->$property);
    }
}
