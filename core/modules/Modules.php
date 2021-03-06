<?php

namespace core\modules;


use Illuminate\Support\Collection;

class Modules
{
    public $name;
    public $version;
    public $description;
    public $status;
    public $localStatus;

    /**
     * @param string $name
     * @param string $version
     * @param string $description
     * @param string $status
     * @param string $localStatus
     */
    public function init($name, $version, $description, $status, $localStatus)
    {
        $this->name = $name;
        $this->version = $version;
        $this->description = $description;
        $this->status = $status;
        $this->localStatus = $localStatus;
    }

    /**
     * @param ModulesSearchRequest $request
     * @param array $modules
     * @return Collection
     */
    public static function search(ModulesSearchRequest $request, array $modules)
    {
        $all = array();
        $hasRequest = false;

        if (isset($request->data['name']) && $request->data['name']) {
            $hasRequest = true;
            foreach ($modules as $value)
                foreach ($value as $item)
                    if (stristr($item->name, $request->data['name'])) {
                        array_push($all, $value);
                        break;
                    }
        }
        if (isset($request->data['version']) && $request->data['version']) {
            $hasRequest = true;
            foreach ($modules as $value)
                foreach ($value as $item)
                    if (stristr($item->version, $request->data['version'])) {
                        array_push($all, $value);
                        break;
                    }

        }
        if (isset($request->data['description']) && $request->data['description']) {
            $hasRequest = true;
            foreach ($modules as $value)
                foreach ($value as $item)
                    if (stristr($item->description, $request->data['description'])) {
                        array_push($all, $value);
                        break;
                    }
        }
        if (isset($request->data['status']) && $request->data['status']) {
            $hasRequest = true;
            foreach ($modules as $value)
                foreach ($value as $item)
                    if (stristr($item->status, $request->data['status'])) {
                        array_push($all, $value);
                        break;
                    }
        }

        if(empty($all) && !$hasRequest)
            $all = $modules;

        return new Collection($all);
    }
}