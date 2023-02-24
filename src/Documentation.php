<?php

namespace AutoDocumentation;

use Illuminate\Filesystem\Filesystem;

class Documentation
{
    protected Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function generate(): void
    {
        $openApi = OpenApi::instance();
        $openApi->setLoader(new Loader($this->filesystem));
        $openApi->setFilesystem($this->filesystem);

        $openApi->load(config('auto-documentation.paths.source'));

        $openApi->storeDocumentation(config('auto-documentation.paths.generated-doc').'/documentation.yaml');
    }
}