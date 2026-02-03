<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Navigation;
use Illuminate\Support\Facades\Auth;

class NavigationComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();

        // Jika belum login
        if (!$user) {
            $view->with('navs', []);
            return;
        }

        $navs = Navigation::with([
            'child' => function ($query) {
                $query->where('active', 1)
                    ->where('display', true)
                    ->orderBy('order', 'asc');
            },
            'child.subChild' => function ($query) {
                $query->where('active', 1)
                    ->where('display', true)
                    ->orderBy('order', 'asc');
            }
        ])
        ->whereNull('parent_id')
        ->where('page', 'admin')
        ->where('active', true)
        ->where('display', true)
        ->orderBy('order')
        ->get()
        ->map(function ($nav) {
            $nav->url = $nav->url !== '#' ? route($nav->url) : '#';

            $nav->child->each(function ($child) {
                $child->url = $child->url !== '#' ? route($child->url) : '#';

                $child->subChild->each(function ($subChild) {
                    $subChild->url = $subChild->url !== '#' ? route($subChild->url) : '#';
                });
            });

            return $nav;
        });

        $filteredNavs = $this->filterPermission($navs->toArray(), $user);

        // Dashboard selalu di paling atas
        $dashboard = collect($filteredNavs)->firstWhere('slug', 'dashboard');
        if ($dashboard) {
            $filteredNavs = array_values(array_filter(
                $filteredNavs,
                fn ($n) => $n['slug'] !== 'dashboard'
            ));
            array_unshift($filteredNavs, $dashboard);
        }

        $view->with('navs', $filteredNavs);
    }

    private function filterPermission(array $navs, $user): array
    {
        $result = [];

        foreach ($navs as $nav) {

            // ✅ DASHBOARD UNTUK SEMUA ROLE
            if ($nav['slug'] === 'dashboard') {
                $result[] = $nav;
                continue;
            }

            // ❗ SETTINGS + ISINYA HANYA ADMIN
            if ($nav['slug'] === 'settings' && !$user->hasRole('Admin')) {
                continue;
            }

            // ROLE NON-ADMIN WAJIB PERMISSION
            if (!$user->hasRole('Admin') && !$user->can($nav['slug'] . '.read')) {
                continue;
            }

            // Filter child
            if (!empty($nav['child'])) {
                $nav['child'] = $this->filterPermission($nav['child'], $user);
            }

            if (!empty($nav['sub_child'])) {
                $nav['sub_child'] = $this->filterPermission($nav['sub_child'], $user);
            }

            $result[] = $nav;
        }

        return $result;
    }
}
