<?php
/**
 * a bit integration test that covers models and database
 */

namespace Springbuck\LaravelCoinhive\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Artisan;

class DatabaseTest extends BaseTestCase
{
    // use RefreshDatabase, DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->createApplication();
        // Artisan::call('migrate --class=');
        // Artisan::call('db:seed --class=');  
    }
    
    /**
     * @dataProvider makeDataProvider
     */
    public function testMakingOfModels()
    {
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreationOfModels()
    {
    }
    
    /**
     * @dataProvider retrieveDataProvider
     */
    public function testRetrievalOfModels()
    {
    }
   
    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdateOfModels()
    {
    }
   
    /**
     * @dataProvider deleteDataProvider
     */
    public function testDeletionOfModels()
    {
    }

    public function makeDataProvider()
    {
        return [
            ["test", "<p>test</p>\n"],
            ["# title", "<h1>title</h1>\n"],
            ["Here's Johnny!", "<p>Here&#8217;s Johnny!</p>\n"],
        ];
    }

    public function createDataProvider()
    {
        return [
            ["test", "<p>test</p>\n"],
            ["# title", "<h1>title</h1>\n"],
            ["Here's Johnny!", "<p>Here&#8217;s Johnny!</p>\n"],
        ];
    }

    public function retrieveDataProvider()
    {
        return [
            ["test", "<p>test</p>\n"],
            ["# title", "<h1>title</h1>\n"],
            ["Here's Johnny!", "<p>Here&#8217;s Johnny!</p>\n"],
        ];
    }

    public function updateDataProvider()
    {
        return [
            ["test", "<p>test</p>\n"],
            ["# title", "<h1>title</h1>\n"],
            ["Here's Johnny!", "<p>Here&#8217;s Johnny!</p>\n"],
        ];
    }

    public function deleteDataProvider()
    {
        return [
            ["test", "<p>test</p>\n"],
            ["# title", "<h1>title</h1>\n"],
            ["Here's Johnny!", "<p>Here&#8217;s Johnny!</p>\n"],
        ];
    }

    public function makeModel($modelName, $data)
    {
    }

    public function createModel($modelName, $data)
    {
    }

    public function retrieveOneModel($modelName, $data)
    {
    }

    public function retrieveManyModel($modelName, $data)
    {
    }

    public function updateModel($modelName, $data)
    {
    }

    public function deleteModel($modelName, $input, $output)
    {
        $m = ucwords($modelName);
        $m::shouldReceive('destroy')
            ->once()
            ->with($input)
            ->andReturn($output);

    }
}