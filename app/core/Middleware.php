<?php

interface MiddlewareInterface {
    public function handle(array $params): bool;
}
