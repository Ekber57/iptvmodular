<?php
namespace Modules\ModuleConf\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class ModuleLinkService
{

    public function getLinks()
    {
        $moduleLinks = [];
        if (Cache::has('module_links')) {
            $moduleLinks = Cache::get('module_links');
            return $moduleLinks;
        } else {
            $modulesPath = base_path('Modules');
            $modules = File::directories($modulesPath);
            foreach ($modules as $modulePath) {
                $linksFilePath = $modulePath . '/module.json';
                if (File::exists($linksFilePath)) {
                    $module = File::get($linksFilePath);
                    $module = json_decode($module);
                    if (isset($module->links)) {
                        if($module->isEnabled) {
                            array_push($moduleLinks, ['name' => $module->display_name, 'links' => $module->links]);
                        }
                    }
                }
            }
            Cache::put('module_links', $moduleLinks, 1000000);
            return $moduleLinks;
        }

    }
}

?>