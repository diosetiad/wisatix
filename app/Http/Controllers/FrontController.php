<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Ticket;
use App\Services\FrontService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $frontService;

    public function __construct(FrontService $frontService)
    {
        $this->frontService = $frontService;
    }

    public function index()
    {
        $data = $this->frontService->getFrontPageData();
        return view('front.index', $data);
    }

    public function category(Category $category)
    {
        return view('front.category', compact('category'));
    }

    public function provider(Provider $provider)
    {
        return view('front.provider', compact('provider'));
    }

    public function details(Ticket $ticket)
    {
        return view('front.details', compact('ticket'));
    }
}
