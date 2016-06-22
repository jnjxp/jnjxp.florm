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
use Jnjxp\Florm\Mapper\LazyInterface;

/**
 * Related
 *
 * @category Mapper
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see LazyInterface
 */
class Related implements LazyInterface
{

    // Has one relation uses Mapper::get
    const HAS_ONE = 'get';

    // Has many relation uses Mapper::getAll
    const HAS_MANY = 'getAll';

    /**
     * Locator
     *
     * @var MapperLocatorInterface
     *
     * @access protected
     */
    protected $locator;

    /**
     * Mapper Name
     *
     * @var string
     *
     * @access protected
     */
    protected $mapper;

    /**
     * Method by which to get entity or entities
     *
     * @var string
     *
     * @access protected
     */
    protected $method;

    /**
     * Identity or Identities to get
     *
     * @var string|array
     *
     * @access protected
     */
    protected $param;

    /**
     * Create a lazy get relationship
     *
     * @param MapperLocatorInterface $locator of mappers
     * @param string                 $method  by which to get content
     * @param string                 $mapper  to get related content from
     * @param string|array           $param   identity/identities to get
     *
     * @access public
     */
    public function __construct(
        MapperLocatorInterface $locator,
        $method,
        $mapper,
        $param
    ) {
        $this->locator = $locator;
        $this->mapper = $mapper;
        $this->method = $method;
        $this->param = $param;
    }

    /**
     * Resolve relationship
     *
     * @return mixed
     *
     * @access public
     */
    public function __invoke()
    {
        $locator = $this->locator->get($this->mapper);
        return call_user_func([$locator, $this->method], $this->param);
    }
}
