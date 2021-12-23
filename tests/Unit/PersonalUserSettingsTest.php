<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class PersonalUserSettingsTest extends TestCase
{
    public function test_a_user_can_get_a_setting(): void
    {
        $settings = ['settings' => ['foo' => 'bar']];

        $user = User::factory()->create($settings);

        // Get existing setting.
        $this->assertEquals('bar', $user->getSetting('foo'));

        // Check default value of non-existent setting.
        $this->assertIsArray($user->getSetting('baz'));

        // Check manually setted default value of non-existent setting.
        $this->assertEquals(5, $user->getSetting('baz', 5));
    }

    public function test_a_user_can_change_settings(): void
    {
        $settings = ['settings' => ['foo' => 'bar']];

        $user = User::factory()->create($settings);

        // Set settings.
        $this->assertEquals('world', $user->setSettings(['foo' => 'world'], false)->getSetting('foo'));
        $this->assertEquals('hello', $user->setSettings(['baz' => 'hello'], false)->getSetting('baz'));
        $this->assertEquals(['foo' => 'bar'], $user->refresh()->settings);
    }

    public function test_a_user_can_change_and_save_settings(): void
    {
        $settings = ['settings' => ['foo' => 'bar']];

        $user = User::factory()->create($settings);

        // Set settings and save.
        $this->assertEquals('world', $user->setSettings(['foo' => 'world'])->getSetting('foo'));
        $this->assertEquals(['foo' => 'world'], $user->refresh()->settings);
    }
}
