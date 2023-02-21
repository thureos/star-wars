<?php

namespace App\Http\Controllers;

use App\Repositories\StarWarsRepository;
use Illuminate\Http\Request;

class StarWarsController extends Controller
{

    private StarWarsRepository $repo;

    public function __construct(StarWarsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function lukesShips()
    {
        return $this->repo->listLukeSkywalkerRelatedStarships();
    }

    public function speciesClassifficationForPhantom()
    {
        return $this->repo->speciesClassificationsFromFirstEpisode();
    }

    public function galaxyPopulation()
    {
        return [
            'population' => $this->repo->galaxysTotalPopulation()
        ];
    }

}
