<?php namespace Modules\Menu\Entities;

use Astrotomic\Translatable\Translatable
use Illuminate\Database\Eloquent\Model;
use TypiCMS\NestableTrait;

class Menuitem extends Model
{
    use Translatable, NestableTrait;

    public $translatedAttributes = ['title', 'uri', 'url', 'status'];
    protected $fillable = [
        'menu_id',
        'page_id',
        'parent_id',
        'position',
        'target',
        'module_name',
        'title',
        'uri',
        'url',
        'status',
        'is_root',
        'icon'
    ];
    protected $table = 'menu__menuitems';

    /**
     * For nested collection
     *
     * @var array
     */
    public $children = [];

    public function menu()
    {
        return $this->belongsTo('Modules\Menu\Entities\Menu');
    }

    /**
     * Make the current menu item child of the given root item
     * @param Menuitem $rootItem
     */
    public function makeChildOf(Menuitem $rootItem)
    {
        $this->parent_id = $rootItem->id;
        $this->save();
    }

    /**
     * Check if the current menu item is the root
     * @return bool
     */
    public function isRoot()
    {
        return (bool) $this->is_root;
    }

    /**
     * Check if page_id is empty and returning null instead empty string
     * @return number
     */
    public function setPageIdAttribute($value)
    {
        $this->attributes['page_id'] = ! empty($value) ? $value : null;
    }
}
