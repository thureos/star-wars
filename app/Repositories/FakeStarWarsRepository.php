<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class FakeStarWarsRepository implements StarWarsRepository
{
    /**
     * Returns a list of Luke's related starships
     * @return Collection 
     * This value will never change so, even instead of using Cache forever, we might as well hardcode the whole value instead
     */
    public function listLukeSkywalkerRelatedStarships(): Collection
    {
        $starships = collect([]);

        foreach(range(1, fake()->numberBetween(2,10)) as $i){
            $starships->push([
                'name'         => fake()->words(3, true),
                'model'        => fake()->words(3, true),
                'manufacturer' => fake()->words(3, true),
            ]);
        }

        return $starships;
    }

    /**
     * Returns classification and species grouped by classification
     * @return Collection 
     * This value will never change so, even instead of using Cache forever, we might as well hardcode the whole value instead
     */
    public function speciesClassificationsFromFirstEpisode(): Collection
    {
        return collect([
            'class_1' => [
                'species_1',
                'species_2',
            ],
            'class_2' => [
                'species_3',
                'species_4',
            ],
        ]);
    }

    /**
     * Returns galaxys total population
     * @return int 
     */
    public function galaxysTotalPopulation(): int
    {
        return fake()->numberBetween(1,99999);
    }
    
}