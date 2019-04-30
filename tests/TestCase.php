<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 * @author Patrik Krhovsky <patrikkrhovsky@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
