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

namespace Jnjxp\Florm\Mapper\Relation;

use Jnjxp\Florm\MapperLocatorInterface;

/**
 * RelatedFactory
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see RelatedFactoryInterface
 */
class RelatedFactory implements RelatedFactoryInterface
{
    /**
     * Locator
     *
     * @var MapperLocatorInterface
     *
     * @access protected
     */
    protected $locator;

    /**
     * Create a factory to specific relationships
     *
     * @param MapperLocatorInterface $locator of mappers
     *
     * @access public
     */
    public function __construct(MapperLocatorInterface $locator)
    {
        $this->locator = $locator;
    }

    /**
     * Create a relationship to lazy get a single entity
     *
     * @param string $mapper   from which to get entity
     * @param string $identity of entity
     *
     * @return mixed
     *
     * @access public
     */
    public function hasOneFrom($mapper, $identity)
    {
        return $this->newRelated(Related::HAS_ONE, $mapper, $identity);
    }

    /**
     * Create a relationship to lazy get multiple entities
     *
     * @param string         $mapper     DESCRIPTION
     * @param array|Iterator $identities DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function hasMany($mapper, $identities)
    {
        if ($identities instanceof Iterator) {
            $identities = iterator_to_array($identities);
        }

        return $this->newRelated(Related::HAS_MANY, $mapper, $identities);
    }

    /**
     * Create a new lazy relation
     *
     * @param string $method for entity/entities retrival
     * @param string $mapper to get entity/entities from
     * @param mixed  $param  identity/identities to get
     *
     * @return Related
     *
     * @access protected
     */
    protected function newRelated($method, $mapper, $param)
    {
        return new Related($this->locator, $method, $mapper, $param);
    }
}
