<?php

namespace App\Api;

interface Fetcher
{
    public function fetch(): array;
}
