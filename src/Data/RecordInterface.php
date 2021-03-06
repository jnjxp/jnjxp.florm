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

namespace Jnjxp\Florm\Data;

use Traversable;
use ArrayAccess;
use Countable;

/**
 * RecordInterface
 *
 * @category Interface
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @interface
 */
interface RecordInterface extends Traversable, ArrayAccess, Countable
{
    /**
     * Has property?
     *
     * @param string $property key
     *
     * @return bool
     *
     * @access public
     */
    public function has($property);

    /**
     * Get a property with fallback
     *
     * @param string $property key
     * @param mixed  $default  value if not set
     *
     * @return mixed
     *
     * @access public
     */
    public function get($property, $default = null);
}
