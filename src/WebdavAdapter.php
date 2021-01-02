<?php


namespace Villaflor\WebdavAdapter;


use League\Flysystem\Config;
use League\Flysystem\Util;
use Sabre\DAV\Client;

class WebdavAdapter extends \League\Flysystem\WebDAV\WebDAVAdapter
{
    private $config;

    public function __construct(Client $client, $config)
    {
        $this->config = $config;
        parent::__construct($client);
    }

    public function getUrl($path): string
    {
        if (!empty($this->config['pathAlias'])) {
            // with this feature you can use symlink to folder
            return $this->config['baseUri'] . $this->config['pathAlias'] . "/download?files=" . $path;
        }

        return $this->config['baseUri'] . $this->config['pathPrefix'] . "/download?files=" . $path;
    }

    public function write($path, $contents, Config $config)
    {
        if (!$this->createDir(Util::dirname($path), $config)) {
            return false;
        }

        $location = $this->applyPathPrefix($this->encodePath($path));
        $response = $this->client->request('PUT', $location, $contents);

        if ($response['statusCode'] >= 400) {
            return false;
        }

        $result = compact('path', 'contents');

        if ($config->get('visibility')) {
            throw new LogicException(__CLASS__.' does not support visibility settings.');
        }

        return $result;
    }

}