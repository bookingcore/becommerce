<?php
namespace Themes\Zeomart\Walkers;
class MenuWalker
{
    protected static $currentMenuItem;
    protected        $menu;
    protected        $activeItems = [];

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function generate($options = [])
    {
        $items = json_decode($this->menu->items, true);
        if (!empty($items)) {
            $options['class'] = (!empty($options['class'])) ? $options['class'] : 'menu';
            echo "<ul class='flex font-medium flex-row space-x-5 text-base -ml-2 {$options['class']}'>";
            $this->generateTree($items);
            echo '</ul>';
        }
    }

    public function generateTree($items = [], $depth = 0, $parentKey = '')
    {

        foreach ($items as $k => $item) {

            $class = e($item['class'] ?? '');
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
            if ($this->checkCurrentMenu($item, $url)) {
                $class .= ' current text-blue-600';
                $this->activeItems[] = $parentKey;
            }
            $toggle = $arrow = "";
            if (!empty($item['children'])) {
                $arrow = '<svg aria-hidden="true" class="w-5 h-5 ml-1 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';
                $toggle = 'data-dropdown-toggle="mega-menu-dropdown-' . $k . '" data-dropdown-placement="bottom-start"';
                $class .= ' menu-item-has-children';
                ob_start();
                $this->generateTree($item['children'], $depth + 1, $parentKey . '_' . $k);
                $html = ob_get_clean();
                if (in_array($parentKey . '_' . $k, $this->activeItems)) {
                    $class .= ' active text-blue-600';
                }
            }
            $class .= ' depth-' . ($depth);
            printf('<li class="menu-item group %s">', $class);
            $class_link = " block py-2 pl-3 pr-4 pt-4 pb-4 ";
            if ($depth != 0) {
                $class_link = " block text-base hover:text-blue-600 ";
            }
            if (!empty($item['children'])) {
                $class_link .= " flex items-center justify-between w-full py-2 pl-3 pr-4 pt-4 pb-4 font-medium ";
            }
            printf('<a class="%s" target="%s" href="%s" %s>%s </a>', $class_link, e($item['target']), e($url), $toggle, clean($item['name']) . $arrow);
            if (!empty($item['children'])) {
                echo '<div id="mega-menu-dropdown-' . $k . '" class="absolute z-10 hidden min-w-[200px] p-5 text-sm bg-white border border-gray-100 rounded-b shadow-md group-hover:block">';
                echo '<ul class="space-y-4 text-[#041E42]">';
                echo $html;
                echo "</ul>";
                echo "</div>";
            }
            echo '</li>';
        }
    }

    protected function checkCurrentMenu($item, $url = '')
    {

        if (trim($url, '/') == request()->path()) {
            return true;
        }
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
