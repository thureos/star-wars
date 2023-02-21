<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface StarWarsRepository
{
    public function listLukeSkywalkerRelatedStarships(): Collection;

    public function speciesClassificationsFromFirstEpisode(): Collection;

    public function galaxysTotalPopulation(): int;
}