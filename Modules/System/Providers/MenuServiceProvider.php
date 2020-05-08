<?php

namespace Modules\System\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Lorisleiva\Actions\EventDispatcherDecorator;
use Modules\Link\Entities\Link;
use Modules\ResourceGroup\Entities\ResourceGroup;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function boot(EventDispatcherDecorator $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $user = Auth::user();

            $application = config('app.id');

            $link_groups = ResourceGroup::where('application_id', $application)->orderBy('name')->get();

            $main_menu = collect();

            //Get all links with sub menus and permission
            $all_links = Link::with(['permission', 'submenus'])
                ->where([
                    'status' => 'On',
                    'parent_link_id' => null
                ])
                ->orderBy('order')
                ->orderBy('title')
                ->get();

            foreach ($link_groups as $group) {

                //Get all links with sub menus and permission
                $links = $all_links->where('resource_group_id', $group->id);

                $filtered_links = $links->filter(function ($link, $key) use ($user) {

                    //if no submenus or it is standard menu
                    if ($link->submenus->count() < 1) {

                        return $link->permission != null ? $user->can($link->permission->name) : true;

                    } else {
                        //has submenus or it is a menu header
                        $sub_links = $link->submenus->filter(function ($sub_menus, $key) use ($user, &$link) {

                            return $sub_menus->permission != null ? $user->can($sub_menus->permission->name) : true;

                        });

                        return $sub_links->count();
                    }
                });
                if ($filtered_links->count()) {

                    $main_menu->push(['header' => $group->name]);

                    foreach ($filtered_links as $link_key => $link) {

                        if ($link->submenus->count()) {

                            $sub_menus = collect();
                            foreach ($link->submenus as $sub_key => $sub_menu) {
                                $sub_menus->push([
                                    'text' => $sub_menu->title,
                                    'url' => $sub_menu->url,
                                    'icon' => $sub_menu->icon,
                                    'active' => [$sub_menu->active_pattern]
                                ]);
                            }

                            $main_menu->push([
                                'text' => $link->title,
                                'url' => '#',
                                'icon' => $link->icon,
                                'active' => [$link->active_pattern],
                                'submenu' => $sub_menus->all()
                            ]);
                        } else {

                            $main_menu->push([
                                'text' => $link->title,
                                'url' => $link->url,
                                'icon' => $link->icon,
                                'active' => [$link->active_pattern]
                            ]);
                        }
                    }
                }
            }

            $event->menu->add(...$main_menu);
        });
    }
}
