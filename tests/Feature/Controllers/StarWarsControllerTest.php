<?php

namespace Tests\Feature;

use App\Repositories\FakeStarWarsRepository;
use App\Repositories\StarWarsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\JsonResponse;

class StarWarsControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        /**
         * You don't test what you don't own, that's why I'm not testing the api part
         */
        app()->bind(StarWarsRepository::class, function(){
            return new FakeStarWarsRepository;
        });
    }

    /** @test */
    public function starships_endpoint_returns_right_structure(): void
    {
        $response = $this->get('/api/star-wars/people/luke/starships');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'name', 
                'model',
                'manufacturer'
            ]
        ]);
    }

    /** @test */
    public function species_classification_endpoint_returns_right_structure(): void
    {
        $response = $this->get('/api/star-wars/films/phantom/species/classification');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'class_1', 
            'class_2'
        ]);
    }

    /** @test */
    public function population_endpoint_returns_right_structure(): void
    {
        /** @var JsonResponse */
        $response = $this->get('/api/star-wars/galaxy/population');

        $response->assertStatus(200);
        $response->assertJsonStructure(['population']);
    }

}
