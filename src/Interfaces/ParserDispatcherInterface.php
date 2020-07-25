<?php

namespace App\Interfaces;

use App\Exceptions\ParserClientEmptyException;

interface ParserDispatcherInterface
{
    /**
     * @return void
     *
     * @throws ParserClientEmptyException
     */
    public function dispatch();

}
