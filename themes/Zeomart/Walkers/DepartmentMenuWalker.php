<?php
namespace Themes\Zeomart\Walkers;

class DepartmentMenuWalker
{
    protected static $currentMenuItem;
    protected        $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function generate()
    {
        $items = json_decode($this->menu->items, true);
        $class = $this->menu->class ?? '';
        if (!empty($items)) {
            echo '<ul class="bc-department '.$class.'">';
            $this->generateTree($items);
            echo '</ul>';
        }
    }

    public function generateTree($items = [] , $depth = 0, $parentKey = '')
    {
        foreach ($items as $item) {
            $class = "flex justify-between items-center ".($item['class'] ?? '');
            $url = $item['url'] ?? '';
            $item['target'] = $item['target'] ?? '';
            if (!isset($item['item_model']))
                continue;
            if (class_exists($item['item_model'])) {
                $itemClass = $item['item_model'];
                $itemObj = $itemClass::find($item['id']);
                if (empty($itemObj)) {
                    continue;
                }
                $url = $itemObj->getDetailUrl();
            }
            $arrow = "";
            if ($this->checkCurrentMenu($item, $url))
                $class .= ' active';
            if(!empty($item['children']))
            {
                $arrow = '<svg width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.86424 3.92329L1.07685 0.135964C0.989247 0.0482965 0.872312 0 0.747627 0C0.622941 0 0.506006 0.0482965 0.418408 0.135964L0.139492 0.41481C-0.0419999 0.59651 -0.0419999 0.891824 0.139492 1.07325L3.31986 4.25362L0.135964 7.43752C0.0483657 7.52518 0 7.64205 0 7.76667C0 7.89142 0.0483657 8.00829 0.135964 8.09602L0.414879 8.3748C0.502546 8.46247 0.619413 8.51077 0.744098 8.51077C0.868783 8.51077 0.985719 8.46247 1.07332 8.3748L4.86424 4.58401C4.95205 4.49607 5.00028 4.37865 5 4.25383C5.00028 4.12852 4.95205 4.01117 4.86424 3.92329Z" fill="#041E42"/></svg>';
            }
            if ($depth != 0) {
                echo '<li class="depth-'.$depth.'">';
            }else{
                echo '<li class="group p-3 hover:text-[#443297] hover:bg-[#F3F5F6] border-b last:border-0">';
            }
            printf('<a class="%s" target="%s" href="%s" >%s</a>', e($class) ,  e($item['target']), e($url), $item['name'].$arrow);
            if (!empty($item['children'])) {
                if(!empty($item['layout']) and $item['layout'] == 'multi_row'){
                    $bg = (!empty($item['bg'])) ? 'style="background: white url('.get_file_url($item['bg'],'full').') right bottom no-repeat; background-size: 230px;"' : '';
                    echo '<div class="hidden absolute left-full top-0 px-8 py-5 h-full bg-[#F3F5F6] min-w-[200px] group-hover:block shadow-md rounded-br-lg" '.$bg.'>';
                        echo '<div class="flex">';
                            $this->generateMultiRowTree($item['children'] , $depth + 1);
                        echo '</div>';
                    echo '</div>';
                }else{
                    echo '<ul class="child-menu">';
                        $this->generateTree($item['children'],$depth + 1);
                    echo "</ul>";
                }
            }
            echo '</li>';
        }
    }

    public function generateMultiRowTree($items = [] , $depth = 0, $parentKey = '')
    {
        foreach ($items as $item) {
            $class = $item['class'] ?? '';
            $url = $item['url'] ?? '';
            $item['target'] = $item['target'] ?? '';
            if (!isset($item['item_model']))
                continue;
            if (class_exists($item['item_model'])) {
                $itemClass = $item['item_model'];
                $itemObj = $itemClass::find($item['id']);
                if (empty($itemObj)) {
                    continue;
                }
                $url = $itemObj->getDetailUrl();
            }
            if ($this->checkCurrentMenu($item, $url))
                $class .= ' active';
            if (!empty($item['children'])) {
                $class.=' menu-item-has-children';
            }
            printf('<div class="%s items min-w-[200px]">', $class);
            printf('<div class="text-lg font-[500] mb-3 text-[#041E42]">%s</div>',  $item['name']);

            if (!empty($item['children'])) {
                    echo '<ul class="space-y-4 text-[#041E42]">';
                        $this->generateTree($item['children'],$depth+1);
                    echo "</ul>";
            }

            echo '</div>';
        }
    }

    protected function checkCurrentMenu($item, $url = '')
    {

        if (!static::$currentMenuItem)
            return false;
        if (empty($item['item_model']))
            return false;
        if (is_string(static::$currentMenuItem) and ($url == static::$currentMenuItem or $url == url(static::$currentMenuItem))) {
            return true;
        }
        if (is_object(static::$currentMenuItem) and get_class(static::$currentMenuItem) == $item['item_model'] && static::$currentMenuItem->id == $item['id']) {
            return true;
        }
        return false;
    }

    public static function setCurrentMenuItem($item)
    {
        static::$currentMenuItem = $item;
    }

    public static function getActiveMenu()
    {
        return static::$currentMenuItem;
    }
}
