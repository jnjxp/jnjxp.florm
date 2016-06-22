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

use IteratorAggregate;

/**
 * AbstractMapper
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see MapperInterface
 *
 * @abstract
 */
abstract class AbstractMapper implements MapperInterface, IteratorAggregate
{
    /**
     * Data Gateway
     *
     * @var GatewayInterface
     *
     * @access protected
     */
    protected $gateway;

    /**
     * IdentityMap
     *
     * @var IdentityMapInterface
     *
     * @access protected
     */
    protected $map;

    /**
     * RelatedFactory
     *
     * @var RelatedFactoryInterface
     *
     * @access protected
     */
    protected $relationships;

    /**
     * Index of all entities
     *
     * @var array
     *
     * @access protected
     */
    protected $index = [];

    /**
     * Create a mapper
     *
     * @param Data\GatewayInterface                   $gateway        to data
     * @param Mapper\IdentityMapInterface             $identityMap    map of entities
     * @param Mapper\Relation\RelatedFactoryInterface $relatedFactory relationships
     *
     * @access public
     */
    public function __construct(
        Data\Gateway $gateway,
        Mapper\IdentityMap $identityMap,
        Mapper\Relation\RelatedFactory $relatedFactory
    ) {
        $this->gateway       = $gateway;
        $this->map           = $identityMap;
        $this->relationships = $relatedFactory;
    }

    /**
     * Get index of all entities
     *
     * @return array
     *
     * @access public
     */
    public function getIndex()
    {
        if (! $this->index) {
            $this->index = $this->gateway->index();
        }
        return $this->index;
    }

    /**
     * Get an entity
     *
     * @param string $identity of entity to get
     *
     * @return mixed
     *
     * @access public
     */
    public function get($identity)
    {
        if ($this->map->has($identity)) {
            return $this->map->get($identity);
        }

        $data   = $this->gateway->read($identity);
        $entity = $this->newEntity($data);

        $this->map->set($identity, $entity);

        return $entity;
    }

    /**
     * GetAll
     *
     * @param array $identities DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function getAllIn(array $identities)
    {
        $all = [];
        foreach ($identities as $identity) {
            $all[$identity] = $this->get($identity);
        }
        return $all;
    }

    /**
     * Get Iterator
     *
     * @return Mapper\MapperIterator
     *
     * @access public
     */
    public function getIterator()
    {
        return new Mapper\MapperIterator($this);
    }

    /**
     * Create a lazy relationship to get a single entity from a mapper
     *
     * @param string $mapper   name
     * @param string $identity of entity to get
     *
     * @return Related
     *
     * @access protected
     */
    protected function hasOneFrom($mapper, $identity)
    {
        return $this->relationships->hasOneFrom($mapper, $identity);
    }

    /**
     * Create a lazy relationship to get multiple entities from a mapper
     *
     * @param string         $mapper     name
     * @param array|iterator $identities of entities to get
     *
     * @return Related
     *
     * @access protected
     */
    protected function hasManyFrom($mapper, $identities)
    {
        return $this->relationships->hasManyFrom($mapper, $identities);
    }

    /**
     * Create a new entity from data record
     *
     * @param Data\Record $record data read
     *
     * @return mixed
     *
     * @access protected
     */
    abstract protected function newEntity(Data\Record $record);
}
