<?php


namespace App\Concerns;

use App\Models\User;

trait HasSettings
{
    public function getSetting(string $name, $default = []): mixed
    {
        if (array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }

        return $default;
    }

    public function setSettings(array $revisions, bool $save = true): User
    {
        $this->settings = array_merge($this->settings, $revisions);

        if ($save) {
            $this->save();
        }

        return $this;
    }
}
