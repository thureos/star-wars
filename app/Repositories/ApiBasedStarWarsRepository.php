<?php

namespace App\Repositories;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApiBasedStarWarsRepository implements StarWarsRepository
{
    private PendingRequest $client;
    private string $url;

    public const EPISODE_ONE_FILM_ID = 4;
    public const LUKE_SKYWWALKER_PERSON_ID = 1;
    public const ENTITY_FILM = 'films';
    public const ENTITY_PERSON = 'people';
    public const ENTITY_STARSHIP = 'starships';

    public static function instance()
    {
        $client = Http::withOptions([]);

        return new self(config('starwars.url'), $client);
    }

    public function __construct(string $url, PendingRequest $client)
    {
        $this->url = $url;
        $this->client = $client;
    }

    public function listLukeSkywalkerRelatedStarships(): Collection
    {
        return Cache::remember('starwars.person.1.starships.list', 10 * 60, function(){
            $luke = $this->getPerson(self::LUKE_SKYWWALKER_PERSON_ID);
            $starships = $this->getEntitiesFromUrls($luke->starships);
            return collect($starships);
        });
    }

    public function speciesClassificationsFromFirstEpisode(): Collection
    {
        return Cache::remember('starwars.film.1.species.classification', 10 * 60, function(){
            $phantom = $this->getFilm(self::EPISODE_ONE_FILM_ID);
            $species = $this->getEntitiesFromUrls($phantom->species);

            return $species->mapToGroups(function($item, $key) {
                return [
                    $item->classification => $item->name
                ];
            });
        });


    }

    public function galaxysTotalPopulation(): int
    {
        return Cache::remember('starwars.galaxy.population', 10 * 60, function(){
            $allPlanets = $this->getAllPlanets();

            return $allPlanets->pluck('population')->filter(fn ($value, $key) => is_numeric($value))->sum();
        });
    }


    /**
     * This can be using some kind of pagination collaborator class, decided just to over engineer it
     */
    private function getAllPlanets(): Collection
    {
        $planets = collect([]);
        $planetsUrl = Str::of($this->url)->append('/planets');

        while($planetsUrl !== null){
            $response = $this->client->get($planetsUrl);
            if($response->successful()){
                $payload = $response->json();
                $planets->push(...$payload['results']);
                $planetsUrl = $payload['next'] ?? null;
            }
        }

        return $planets;
    }

    private function getFilm(int $id): object
    {
        return $this->getEntity(self::ENTITY_FILM, $id);
    }

    public function getPerson(int $id): object
    {
        return $this->getEntity(self::ENTITY_PERSON, $id);
    }

    private function getEntity(string $entity, int $id): object
    {
        $resourceUrl = Str::of($this->url)
            ->append('/')
            ->append($entity)
            ->append('/')
            ->append($id);

        return $this->client->get($resourceUrl)->object();
    }

    private function getEntitiesFromUrls(array $urls): Collection
    {
        $collection = collect([]);

        foreach($urls as $url){
            $collection->push($this->client->get($url)->object());
        }

        return $collection;
        
    }
    
}