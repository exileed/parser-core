<?php

namespace App\Clients;

use DOMNodeList;
use DOMNode;

interface ParserClientTerminalInterface
{
    /**
     * @return void
     */
    public function clear();

    /**
     * @param DOMNodeList|DOMNode|DOMNode[]|string|null $node
     *
     * @return void
     */
    public function add($node);

    /**
     * @return static
     */
    public function first();

    /**
     * @param string|null $default
     * @param bool $normalizeWhitespace
     *
     * @return string
     */
    public function text(string $default = null, bool $normalizeWhitespace = true);

    /**
     * @param string|null $default
     *
     * @return string
     */
    public function html(string $default = null);

    /**
     * @param array $attributes
     *
     * @return string[]
     */
    public function extract(array $attributes);

    /**
     * @param string $selector
     *
     * @return static
     */
    public function filter(string $selector);
}