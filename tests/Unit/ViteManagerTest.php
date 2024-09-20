<?php

namespace Tests\Unit;

use App\Vite\ViteManifestNotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\Vite\ViteManager;
use App\Vite\Manifest;

#[CoversClass(ViteManager::class)]
class ViteManagerTest extends TestCase
{
    public ViteManager $vite;
    const string TEST_MANIFEST_PATH = TEST_PATH.'/fixtures/manifest.json';

    public function setUp(): void
    {
        parent::setUp();
        $this->vite = new ViteManager(
            TEST_PATH.'/fixtures',
            self::TEST_MANIFEST_PATH
        );

    }

    public function test_create_vite_manager_default_settings() : void
    {
        $vite = new ViteManager(
            TEST_PATH.'/fixtures',
            self::TEST_MANIFEST_PATH
        );

        $this->assertEquals('localhost', $vite->host);
        $this->assertEquals(5173, $vite->port);
    }


    public function test_not_found_manifest() : void
    {
        $this->expectException(ViteManifestNotFoundException::class);
        $this->expectExceptionMessage('Manifest not found at: ');

        $this->vite->loadManifest('');
    }

    public function test_load_manifest(): void
    {
        $this->vite->loadManifest(self::TEST_MANIFEST_PATH);
        $this->assertInstanceOf(Manifest::class, $this->vite->getManifest());
    }


    public function test_get_asset_by_file_name(): void
    {
        $this->assertEquals(
            'fixtures/assets/calendar-CyZpG2yd.js',
            $this->vite->get('view/entries/calendar.jsx')
        );
    }

    public function test_get_react_refresh_script() : void
    {
        $vite = new ViteManager(
            dist: TEST_PATH.'/fixtures',
            customManifest: self::TEST_MANIFEST_PATH,
            port: 5173
        );

        $refreshScript = $vite->addReactRefresh();

        $expectedRefresh = file_get_contents(APP_ROOT.'/Vite/react-refresh.html');
        $expectedRefresh = str_replace('{port}', "5173", $expectedRefresh);

        $this->assertEquals($expectedRefresh, $refreshScript);
    }

}