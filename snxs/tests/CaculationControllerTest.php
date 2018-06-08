<?php
namespace Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
//use DB;
use Illuminate\Database\Connection;
use snxs\Http\Controllers\UpdateController;
use Illuminate\Http\Request;

class CaculationControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

    }

    public function testIndex()
    {
        $controller = new UpdateController();
        $request = new Request();
        $request->headers->set('content-type', 'application/json');

        $view = $controller->index($request);

        $this->assertArrayHasKey('todayData', $view->getData());
    }

}
