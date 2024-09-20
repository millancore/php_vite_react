<?php

namespace Tests\Unit;

use App\Vite\Asset;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\Vite\Manifest;

#[CoversClass(Manifest::class)]
class ManifestTest extends TestCase
{
    private Manifest $manifest;

    public function setUp(): void
    {
        parent::setUp();

        $this->manifest = Manifest::fromArray(json_decode(
                file_get_contents(TEST_PATH.'/fixtures/manifest.json'),
                true),
        );
    }

    public function test_create_manifest_from_array() : void
    {
        $this->assertInstanceOf(Manifest::class, $this->manifest);
    }

    public function test_has_asset_by_file() : void
    {
        $this->assertTrue($this->manifest->hasAssetByFile('view/css/index.css'));
        $this->assertFalse($this->manifest->hasAssetByFile('not-exists'));
    }

    public function test_get_asset_by_file() : void
    {
        $asset = $this->manifest->getAssetByFile('view/entries/calendar.jsx');

        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertEquals('assets/calendar-CyZpG2yd.js', $asset->file);
    }

}