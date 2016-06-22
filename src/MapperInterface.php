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

namespace Jnjxp\Florm;

/**
 * MapperInterface
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @interface
 */
interface MapperInterface
{

    /**
     * Get index of all entities
     *
     * @return array
     *
     * @access public
     */
    public function getIndex();

    /**
     * Get an entity
     *
     * @param string $identity of entity to get
     *
     * @return mixed
     *
     * @access public
     */
    public function get($identity);
}
