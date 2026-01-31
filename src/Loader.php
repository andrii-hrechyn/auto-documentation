<?php

namespace AutoDocumentation;

use AutoDocumentation\Exceptions\AutoDocumentationException;
use Illuminate\Filesystem\Filesystem;

class Loader
{
    public function __construct(
        protected Filesystem $filesystem
    ) {
    }

    public function load(string $documentationSourcePath): void
    {
//        $documentationSourcePath = rtrim($documentationSourcePath, '/');
//
//        if (!$this->filesystem->isDirectory($documentationSourcePath)) {
//            throw new AutoDocumentationException("$documentationSourcePath doest not exist.It needs to be directory with documentations");
//        }
//
//        $this->loadInfo($documentationSourcePath);
        $this->loadPaths($documentationSourcePath);
    }

    private function loadInfo(string $path): void
    {
        $filename = $path.'/info.php';

        if (!$this->filesystem->exists($filename)) {
            throw new AutoDocumentationException("$filename file doesnt exist. This file needs to contain information about documentation");
        }

        require_once $path.'/info.php';
    }

    private function loadPaths(string $path): void
    {
        foreach ($this->filesystem->allFiles($path.'/Paths') as $file) {
            dd($file->getPathname());
        }
    }
}
