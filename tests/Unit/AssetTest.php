<?php

namespace Tests\Unit;

use App\Vite\Asset;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Asset::class)]
class AssetTest extends TestCase
{

    public function test_create_import_asset(): void
    {
        $asset = new Asset(
            origin: '_Calendar-Ccd2vCpo.js',
            file: 'assets/Calendar-Ccd2vCpo.js',
            name: 'Calendar'
        );

        $this->assertEquals('Calendar', $asset->name);
    }

    public function test_create_entry_asset_with_css(): void
    {
        $asset = new Asset(
            origin: 'view/entries/custom-calendar.jsx',
            file: 'assets/custom_calendar-Q13qeHZ9.js',
            name: 'custom_calendar',
            src: 'view/entries/custom-calendar.jsx',
            isEntry: true,
            imports: [
                '_Calendar-Ccd2vCpo.js'
            ],
            css: [
                'assets/custom_calendar-BHxNh5Na.css'
            ]);

        $this->assertTrue($asset->isEntry);
        $this->assertEquals('custom_calendar', $asset->name);
        $this->assertEquals('assets/custom_calendar-BHxNh5Na.css', $asset->css[0]);
    }

    public function test_create_asset_from_array(): void
    {
        $asset = Asset::fromArray(
            'view/entries/custom-calendar.jsx', [
            "file" => "assets/custom_calendar-Q13qeHZ9.js",
            "name" => "custom_calendar",
            "src" => "view/entries/custom-calendar.jsx",
            "css" => [
                "assets/custom_calendar-BHxNh5Na.css",
            ],
        ]);

       $this->assertEquals('custom_calendar', $asset->name);
       $this->assertFalse($asset->isEntry);
       $this->assertEquals('assets/custom_calendar-BHxNh5Na.css', $asset->css[0]);
    }


}