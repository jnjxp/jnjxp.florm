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
 * @category  Data
 * @package   Jnjxp\Florm
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/jnjxp/jnjxp.florm
 */

namespace Jnjxp\Florm\Data\Fs;

use Jnjxp\Florm\Data\Exception;

/**
 * JSON Directory Data Reader
 *
 * @category Data
 * @package  Jnjxp\Florm
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/jnjxp/jnjxp.florm
 *
 * @see ReaderInterface
 */
class Reader implements ReaderInterface
{
    /**
     * Root directory of data
     *
     * @var string
     *
     * @access protected
     */
    protected $root;

    /**
     * Create a data reader
     *
     * @param string $root directory of data
     *
     * @access public
     */
    public function __construct($root = null)
    {
        $this->root = rtrim($root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        if (! is_dir($this->root)) {
            throw new Exception(
                "Root directory not found at [$root]"
            );
        }
    }

    /**
     * Read index of all records in directory
     *
     * @param string $type of entity to index
     *
     * @return array
     *
     * @access public
     */
    public function index($type)
    {
        $path = $this->path($type);
        $spec = $path . '*.json';

        $data  = glob($spec);
        $index = [];

        foreach ($data as $path) {
            $index[] = basename($path, '.json');
        }

        return $index;
    }

    /**
     * Read a record
     *
     * @param string $type     of entity to read
     * @param string $identity of entity to read
     *
     * @return array
     *
     * @access public
     */
    public function read($type, $identity)
    {
        $path = $this->path($type);
        $spec = $path . $identity . '.json';

        return json_decode($this->readFs($spec), true);
    }

    /**
     * Read file system
     *
     * @param string $path to file
     *
     * @return string
     *
     * @access protected
     */
    protected function readFs($path)
    {
        $level = error_reporting(0);
        $result = file_get_contents($path);
        error_reporting($level);
        if ($result !== false) {
            return $result;
        }
        $error = error_get_last();
        throw new Exception($error['message']);
    }

    /**
     * Get the path to a type of entity data store
     *
     * @param string $type of entity for which to get path
     *
     * @return string
     *
     * @access protected
     */
    protected function path($type)
    {
        $path = $this->root . $type . DIRECTORY_SEPARATOR;
        if (! is_dir($path)) {
            throw new Exception(
                "[$type] directory not found at [$path]"
            );
        }
        return $path;
    }
}
