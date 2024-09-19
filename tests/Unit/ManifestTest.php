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

    public function test_get_asset_by_name() : void
    {
        $asset = $this->manifest->getAssetByName('calendar');

        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertEquals('assets/calendar-CyZpG2yd.js', $asset->file);
    }
}