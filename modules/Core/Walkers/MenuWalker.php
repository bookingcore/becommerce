<?php
	namespace Modules\Core\Walkers;
	class MenuWalker
	{
		protected static $currentMenuItem;
		protected        $menu;
		protected $activeItems = [];

		public function __construct($menu)
		{
			$this->menu = $menu;
		}

		public function generate($options = [])
		{
			$items = json_decode($this->menu->items, true);
			if (!empty($items)) {
                $options['class'] = (!empty($options['class'])) ? $options['class'] : 'menu';
				echo "<ul class='navbar-nav {$options['class']}'>";
				$this->generateTree($items);
				echo '</ul>';
			}
		}

		public function generateTree($items = [],$depth = 0,$parentKey = '')
		{

			foreach ($items as $k=>$item) {

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
				if ($this->checkCurrentMenu($item, $url))
				{
					$class .= ' current c-main';
					$this->activeItems[] = $parentKey;
				}

                $toggle = "";
				if (!empty($item['children'])) {
                    $toggle = 'data-bs-toggle="dropdown"';
                    $class .= ' dropdown menu-item-has-children';
					ob_start();
					$this->generateTree($item['children'],$depth + 1,$parentKey.'_'.$k);
					$html = ob_get_clean();
					if(in_array($parentKey.'_'.$k,$this->activeItems)){
						$class.=' active ';
					}
				}
				$class.=' depth-'.($depth);
				printf('<li class="nav-item %s">', $class);
				$class_link = "nav-link ps-0 pe-4 ";
				if ($depth != 0) {
                    $class_link = "dropdown-item ";
				}
                if (!empty($item['children'])) {
                    $class_link .= "dropdown-toggle ";
                }
                printf('<a class="%s c-000000 py-2" target="%s" href="%s" %s>%s <i class="axtronic-icon-angle-down"></i> </a>',$class_link, e($item['target']), e($url) , $toggle , clean($item['name']));
				// printf('<a class="%s c-000000 py-2" target="%s" href="%s" %s>%s </a>',$class_link, e($item['target']), e($url) , $toggle , clean($item['name']));
				if (!empty($item['children'])) {
					echo '<ul class="dropdown-menu">';
					echo $html;
					echo "</ul>";
				}
				echo '</li>';
			}
		}

		protected function checkCurrentMenu($item, $url = '')
		{

			if(trim($url,'/') == request()->path()){
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
