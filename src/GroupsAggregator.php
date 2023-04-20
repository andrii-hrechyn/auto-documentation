<?php

namespace AutoDocumentation;

use AutoDocumentation\Paths\Path;
use Illuminate\Support\Arr;

trait GroupsAggregator
{
    protected function groupsFromPaths(array $paths): array
    {
        $groups = [];

        /** @var Path $path */
        foreach ($paths as $path) {
            $groups[$path->getGroup()][] = $path->getTags();
        }

        return collect($groups)
            ->map(function (array $tags, string $name) {
                return [
                    'name' => ucfirst($name),
                    'tags' => array_map(fn(string $tag) => ucfirst($tag), array_values(array_unique(Arr::collapse($tags)))),
                ];
            })
            ->values()
            ->toArray();
    }
}