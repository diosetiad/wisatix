<?php

namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;

class ProviderRepository implements ProviderRepositoryInterface
{
  public function getAllProviders()
  {
    return Provider::latest()->get();
  }
}
