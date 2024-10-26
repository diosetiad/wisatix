<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;

class FrontService
{
  protected $categoryRepository;
  protected $providerRepository;
  protected $ticketRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository, ProviderRepositoryInterface $providerRepository, TicketRepositoryInterface $ticketRepository)
  {
    $this->categoryRepository = $categoryRepository;
    $this->providerRepository = $providerRepository;
    $this->ticketRepository = $ticketRepository;
  }

  public function getFrontPageData()
  {
    $categories = $this->categoryRepository->getAllCategories();
    $providers = $this->providerRepository->getAllProviders();
    $popularTickets = $this->ticketRepository->getPopularTickets(4);
    $newTickets = $this->ticketRepository->getAllNewTickets();

    return compact('categories', 'providers', 'popularTickets', 'newTickets');
  }
}
