<?php
/**
 * A bit integration test that covers routes and controllers
 */
namespace Springbuck\LaravelCoinhive\Tests;

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Artisan;

class RoutesTest extends BaseTestCase
{
    // use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        // Artisan::call('migrate');
        // Artisan::call('db:seed');    
        // Mail::pretend(true);
    }

    public function testForMeta()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/vnd.coinhive.v1+json'
        ])->json('GET', '/api/coinhive/meta');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Laravel Coinhive', 
                    'version' => '0.0.0'
                ]
            ]);
    }

//     public function xTest()
//     {
//         //get|
//         $response = $this->withHeaders([
//             'X-Header' => 'Value',
//         ])->json('POST', '/user', ['name' => 'Sally']);

//         $response
//             ->assertStatus(200)
//             ->assertJson([
//                 'created' => true,
//             ]) ->assertExactJson([
//                 'created' => true,
//             ]);
//     }

    // public function testAvatarUpload()
    // {
    //     Storage::fake('avatars');

    //     $response = $this->json('POST', '/avatar', [
    //         'avatar' => UploadedFile::fake()->image('avatar.jpg', $width, $height)->size(100) //UploadedFile::fake()->create('document.pdf', $sizeInKilobytes);
    //     ]);

    //     // Assert the file was stored...
    //     Storage::disk('avatars')->assertExists('avatar.jpg');

    //     // Assert a file does not exist...
    //     Storage::disk('avatars')->assertMissing('missing.jpg');
    // }
}

// $response->assertJson(array $data); 
// $response->assertJsonFragment(array $data); 
// $response->assertJsonMissing(array $data);
// $response->assertExactJson(array $data); 
// $response->assertJsonStructure(array $structure); 	
// $response->assertSuccessful();
// $response->assertStatus($code); 	
// $response->assertRedirect($uri); 
// $response->assertHeader($headerName, $value = null); 
