<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Menu;
use CodeBot\Build\Solid;

class MenusController extends Controller
{
    use \App\Http\Controllers\ApiControllerTrait;

    protected $model;
    protected $relationships = ['menu_buttons'];

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function setMenu($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));

        $result = $bot->addMenu($menu->locale, $menu->composer_input_disabled, $menu->menu_buttons->toArray());

        $menu->facebook_diff = false;
        $menu->save();

        return $result;
    }

    public function removeMenu()
    {

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));

        return $bot->removeMenu();
    }
}