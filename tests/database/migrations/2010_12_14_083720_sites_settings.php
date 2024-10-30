<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->createSetting('sites.site_name', '3x1');
        $this->createSetting('sites.site_description', 'Creative Solutions');
        $this->createSetting('sites.site_keywords', 'Graphics, Marketing, Programming');
        $this->createSetting('sites.site_profile', '');
        $this->createSetting('sites.site_logo', '');
        $this->createSetting('sites.site_author', 'Fady Mondy');
        $this->createSetting('sites.site_address', 'Cairo, Egypt');
        $this->createSetting('sites.site_email', 'info@3x1.io');
        $this->createSetting('sites.site_phone', '+201207860084');
        $this->createSetting('sites.site_phone_code', '+2');
        $this->createSetting('sites.site_location', 'Egypt');
        $this->createSetting('sites.site_currency', 'EGP');
        $this->createSetting('sites.site_language', 'English');
        $this->createSetting('sites.site_social', []);
    }


    /**
     * @param string $setting
     * @param mixed $value
     * @return void
     */
    private function createSetting(string $setting, mixed $value): void
    {
        $exSetting = explode('.', $setting);
        $group = $exSetting[0];
        $name = $exSetting[1];

        $settingExists = \Illuminate\Support\Facades\DB::table('settings')
            ->where('name', $name)
            ->where('group',  $group)
            ->first();

        if(!$settingExists){
            \Illuminate\Support\Facades\DB::table('settings')
                ->insert([
                    'group' => $group,
                    'name' => $name,
                    'locked' => 0,
                    'payload' => json_encode($value),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }
};