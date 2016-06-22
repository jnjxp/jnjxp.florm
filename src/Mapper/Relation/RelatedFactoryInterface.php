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

namespace Jnjxp\Florm\Mapper\Relation;

/**
 * Interface for factory to create lazy relationships
 *
 * @category Interface
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 */
interface RelatedFactoryInterface
{
    /**
     * Create a Related to fetch a single entity from a mapper
     *
     * @param string $mapper   from which to get entity
     * @param string $identity identity of entity to get
     *
     * @return Related
     *
     * @access public
     */
    public function hasOneFrom($mapper, $identity);

    /**
     * Create a Related to fetch all specified entities from a mapper
     *
     * @param string $mapper     from which to get entities
     * @param array  $identities identites of entities to get
     *
     * @return Related
     *
     * @access public
     */
    public function hasManyFrom($mapper, $identities);
}
