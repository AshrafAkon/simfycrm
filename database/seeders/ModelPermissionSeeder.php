<?php

namespace Database\Seeders;


use App\Permission;
use Illuminate\Database\Seeder;


class ModelPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$models = $this->getModels();
        //print_r($models);
        $permission_types = ['create', 'edit', 'delete'];
        $models = ['product', 'invoice', 'customer', 'role', 'setting', 'expense', 'courier'];
        foreach ($models as $model) {
            foreach ($permission_types as $permission_type) {
                Permission::findOrCreate(['name' => $model . $permission_type]);
            }
        }
    }

    // public function getModels(): Collection
    // {
    //     $models = collect(File::allFiles(app_path()))
    //         ->map(function ($item) {
    //             $path = $item->getRelativePathName();
    //             $class = sprintf(
    //                 '\%s%s',
    //                 Container::getInstance()->getNamespace(),
    //                 strtr(substr($path, 0, strrpos($path, '.')), '/', '\\')
    //             );

    //             return $class;
    //         })
    //         ->filter(function ($class) {
    //             $valid = false;

    //             if (class_exists($class)) {
    //                 $reflection = new \ReflectionClass($class);
    //                 $valid = $reflection->isSubclassOf(Model::class) &&
    //                     !$reflection->isAbstract();
    //             }

    //             return $valid;
    //         });

    //     return $models->values()->map(function ($item) {
    //         return substr(
    //             $item,
    //             -1 * strrpos($item, "/"),
    //         );
    //     });
    // }
}
