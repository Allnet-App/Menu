<?php namespace Modules\Menu\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Menu\Events\MenuWasCreated;
use Modules\Menu\Repositories\MenuRepository;

class EloquentMenuRepository extends EloquentBaseRepository implements MenuRepository
{
    public function create($data)
    {
        $menu = $this->model->create($data);

        event(new MenuWasCreated($menu));

        return $menu;
    }

    public function update($menu, $data)
    {
        $menu->update($data);

        return $menu;
    }
}
