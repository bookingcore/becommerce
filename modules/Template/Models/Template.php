<?php
namespace Modules\Template\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Template\BlockManager;
use PhpParser\Node\Expr\Cast\Object_;

class Template extends BaseModel
{
    protected $table = 'core_templates';
    protected $fillable = [
        'title',
        'content',
        'type_id',
    ];


    public static function getModelName()
    {
        return __("Template");
    }

    public static function getAsMenuItem($id)
    {
        return parent::select('id', 'title as name')->find($id);
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if ($q) {
            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public function editUrl(): Attribute
    {
        return Attribute::make(
            get:function($value){
                return url('admin/module/template/edit/' . $this->id);
            }
        );
    }

    public function contentJson(): Attribute
    {
        return Attribute::make(
            get:function($value){
                $json = json_decode($this->content, true);
                $this->filterContentJson($json);
                return $json;
            }
        );
    }

    protected function filterContentJson(&$json)
    {

        if (!empty($json)) {
            foreach ($json as $k => &$item) {
                if (!isset($item['type'])) {
                    unset($json[$k]);
                    continue;
                }
                $block = $this->getBlockByType($item['type']);
                if (empty($block)) {
                    unset($json[$k]);
                    continue;
                }
                $item['is_container'] = $block['is_container'] ?? false;
                $item['component'] = $block['component'] ?? 'RegularBlock';
                if (isset($item['settings']))
                    unset($item['settings']);
                if (empty($item['model']))
                    $item['model'] = [];
                if (!empty($block['model'])) {
                    foreach ($block['model'] as $key => $val) {
                        if (!isset($item['model'][$key]))
                            $item['model'][$key] = $val;
                    }
                }
                if (!empty($item['children'])) {
                    $this->filterContentJson($item['children']);
                }
            }
        }
        $json = array_values((array)$json);
    }

    public function getBlocks()
    {
        return BlockManager::blocks();
    }

    public function getBlockByType($type)
    {
        $all = $this->getBlocks();
        if (!empty($all)) {
            foreach ($all as $block) {
                if ($type == $block['id'])
                    return $block;
            }
        }
        return false;
    }

    public function getAllBlocks(){
        return BlockManager::all();
    }

    public function getProcessedContent()
    {
        return BlockManager::content($this);
    }

    public function getProcessedContentAPI(){
        return BlockManager::contentAPI($this);
    }
}
