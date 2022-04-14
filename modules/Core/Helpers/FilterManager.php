<?php
namespace Modules\Core\Helpers;
class FilterManager extends BaseAction
{
    protected $value = '';
    /**
     * Filters a value.
     *
     * @param string $action Name of filter
     * @param array $args Arguments passed to the filter
     *
     * @return string Always returns the value
     */
    public function fire($action, $args)
    {
        $this->value = isset($args[0]) ? $args[0] : ''; // get the value, the first argument is always the value
        if ($this->getListeners()) {
            $this->getListeners()->where('hook', $action)->each(function ($listener) use ($action, $args) {
                $this->value = call_user_func_array($this->getFunction($listener['callback']), $args);
            });
        }
        return $this->value;
    }
}
