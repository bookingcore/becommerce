<?php


namespace Modules\Media\CustomGcs;


use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class CustomGoogleStorageAdapter extends GoogleStorageAdapter
{
    /**
     * {@inheritdoc}
     */
    public function copy($path, $newpath)
    {
        $newpath = $this->applyPathPrefix($newpath);

        // we want the new file to have the same visibility as the original file
        $visibility = $this->getRawVisibility($path);

        $options = [
            'name' => $newpath,
        ];
        $this->getObject($path)->copy($this->bucket, $options);

        return true;
    }
    /**
     * Returns an array of options from the config.
     *
     * @param Config $config
     *
     * @return array
     */
    protected function getOptionsFromConfig(Config $config)
    {
        $options = [];

        if ($metadata = $config->get('metadata')) {
            $options['metadata'] = $metadata;
        }

        return $options;
    }
}
