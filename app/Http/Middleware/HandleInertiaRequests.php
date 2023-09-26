<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use App\Facades\PageFrontFacade;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $page_front = '';
        if(!empty($request->guard())){
            $page_info = PageFrontFacade::getInfoPageActual();
            $page_front = [
                'menuLinks' => PageFrontFacade::getLinks(),
                'title' => $page_info['title'],
                'route_current' => $page_info['route'],
            ];
        }
        return array_merge(parent::share($request), [
            'routes_fortify' => routesFortify(),
            'guard' => $request->guard(),
            'isRouteAdmin' => $request->isAdmin(),
            'page_front' => $page_front,
            'fn_data' => session('data') ?? null,
            'auth' => [
                'user' => $request->user()
                    ? $request->user()->only(
                        'id',
                        'name',
                        'email',
                        'email_verified_at'
                    )
                    : null
            ]
        ]);
    }
}
