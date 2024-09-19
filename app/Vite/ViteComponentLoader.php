<?php

namespace App\Vite;

class ViteComponentLoader
{
    private Manifest $manifest;

    /**
     * @throws ViteManifestNotFoundException
     */
    public function __construct(string $path)
    {
        $this->manifest = Manifest::fromArray(
            $this->resolveManifest($path)
        );
    }

    public function getManifest() : Manifest
    {
        return $this->manifest;
    }

    /**
     * @return array<mixed>
     * @throws ViteManifestNotFoundException
     */
    public function resolveManifest(string $buildDirectory): array
    {
        if (!file_exists($buildDirectory.'/manifest.json')) {
            throw new ViteManifestNotFoundException("Manifest not found at: $buildDirectory");
        }

        return json_decode(file_get_contents($buildDirectory.'/manifest.json'), true);
    }

    public function component(string $name) : ?string
    {
        return 'dist/'. $this->manifest->getAssetByName($name)?->file;
    }

    public function addReactRefresh(int $port = 5173) : ?string
    {
        if (!$this->isRunningDevServer()) {
            return null;
        }

        $refreshScript = file_get_contents(__DIR__.'/react-refresh.html');

        return str_replace('{port}', $port, $refreshScript);
    }


    public function isRunningDevServer() : bool
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:5173');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_exec($ch);

        return curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
    }


    public function styles(string $name) : string
    {
        $asset = $this->manifest->getAssetByName($name);

        $cssFile = $asset->css[0];

        return 'dist/'.$cssFile;
    }

}