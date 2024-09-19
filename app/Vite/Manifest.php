<?php

namespace App\Vite;

class Manifest
{
    /** @var array<Asset> $index */
    private array $index = [];

    /** @var array<Asset> $assets */
    private array $assets = [];

    /**
     * @param array<mixed> $rawManifest
     * @return Manifest
     */
    public static function fromArray(array $rawManifest): Manifest
    {
        $newManifest = new Manifest();

        foreach ($rawManifest as $key => $value) {
            $newManifest->addAsset(Asset::fromArray($key, $value));
        }

        return $newManifest;
    }

    public function addAsset(Asset $asset): Manifest
    {
        $this->assets[] = $asset;

        if ($asset->name) {
            $this->index[$asset->name] = $asset;
        }

        return $this;
    }

    /**
     * @return Asset[]
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    public function getAssetByName(string $name): ?Asset
    {
        if(!isset($this->index[$name])) {
            return null;
        }

        return $this->index[$name];
    }

}