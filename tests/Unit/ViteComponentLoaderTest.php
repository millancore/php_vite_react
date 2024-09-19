<?php

namespace Tests\Unit;

use App\Vite\ViteManifestNotFoundException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\Vite\ViteComponentLoader;
use App\Vite\Manifest;

#[CoversClass(ViteComponentLoader::class)]
class ViteComponentLoaderTest extends TestCase
{
    const string TEST_MANIFEST_PATH = TEST_PATH.'/fixtures';

    public function test_not_found_manifest() : void
    {
        $this->expectException(ViteManifestNotFoundException::class);
        $this->expectExceptionMessage('Manifest not found at: ');

        new ViteComponentLoader('');
    }

    public function test_load_manifest(): void
    {
        $vite = new ViteComponentLoader(self::TEST_MANIFEST_PATH);

        $this->assertInstanceOf(Manifest::class, $vite->getManifest());
    }


    public function test_get_components_js_file(): void
    {
        $vite = new ViteComponentLoader(self::TEST_MANIFEST_PATH);

        $this->assertEquals('assets/calendar-CyZpG2yd.js', $vite->component('calendar'));

    }

    public function test_get_react_refresh_script() : void
    {
        $vite = new ViteComponentLoader(self::TEST_MANIFEST_PATH);

        $port = 5173;

        $refreshScript = $vite->addReactRefresh($port);

        $expectedRefresh = file_get_contents(APP_ROOT.'/Vite/react-refresh.html');
        $expectedRefresh = str_replace('{port}', $port, $expectedRefresh);

        $this->assertEquals($expectedRefresh, $refreshScript);
    }

}