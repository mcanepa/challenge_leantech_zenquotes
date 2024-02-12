<?php

namespace Tests\Unit;

use App\Http\Controllers\QuoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FeatureTodayTest extends TestCase
{
    public function testCacheIsClear()
    {
        $this->assertFalse(Cache::has('today'));
    }

    public function testCacheIsNotEmpty()
    {
        $response = $this->get('/today');

        $this->assertTrue(Cache::has('today'));
    }

    public function testResponseIsCached()
    {
        $response = $this->get('/today');

        $response->assertSeeText('cached');
    }

    // public function testReloadCache()
    // {
    //     $response = $this->get('/today/new');

    //     $response->assertDontSeeText('cached');
    // }
}
