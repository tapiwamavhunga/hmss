<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateLandingAboutUsRequest;
use App\Models\LandingAboutUs;
use App\Repositories\LandingAboutUsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class AboutUsController extends AppBaseController
{
    /**
     * @return Factory|View
     */
    public function index(): View
    {
        $landingAboutUs = LandingAboutUs::first();

        return view('landing.about_us.index', compact('landingAboutUs'));
    }

    /**
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function update(UpdateLandingAboutUsRequest $request): RedirectResponse
    {
        /** @var LandingAboutUsRepository $repo */
        $repo = App::make(LandingAboutUsRepository::class);
        $repo->updateLandingAboutUs($request->all());

        \Flash::success(__('messages.about_us').' '.__('messages.common.updated_successfully'));

        return redirect(route('super.admin.about.us'));
    }
}
