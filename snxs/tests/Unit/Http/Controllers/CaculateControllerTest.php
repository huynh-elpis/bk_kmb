<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Mockery as m;
use App\City;
use Illuminate\Database\Connection;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\CaculateController;

class CaculateControllerTest extends TestCase
{
      /**
     * @var \Mockery\Mock|\Illuminate\Database\Connection
     */
    protected $db;

    /**
     * @var \Mockery\Mock|App\City
     */
    protected $xsMock;
    /**
     * Display a listing of the resource.
     * Equal Rule
     * @return \Illuminate\Http\Response
     */
    public function setUp()
    {
        $this->afterApplicationCreated(function () {
            $this->db = m::mock(
                Connection::class.'[select,update,insert,delete]',
                [m::mock(\PDO::class)]
            );

            $manager = $this->app['db'];
            $manager->setDefaultConnection('mock');

            $r = new \ReflectionClass($manager);
            $p = $r->getProperty('connections');
            $p->setAccessible(true);
            $list = $p->getValue($manager);
            $list['mock'] = $this->db;
            $p->setValue($manager, $list);

            $this->cityMock = m::mock(City::class . '[update, delete]');
        });

        parent::setUp();
    }
}
