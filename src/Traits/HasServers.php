<?php

namespace AutoDocumentation\Traits;

use AutoDocumentation\Server;
use Illuminate\Support\Collection;

trait HasServers
{
    protected array $servers = [];

    public function server(Server $server): static
    {
        $this->servers[$server->getUrl()] = $server;

        return $this;
    }

    public function servers(array $servers): static
    {
        foreach ($servers as $server) {
            if (!$server instanceof Server) {
                throw new \Exception('Server object must implement '.Server::class);
            }

            $this->server($server);
        }

        return $this;
    }

    public function getServers(): Collection
    {
        return collect($this->servers);
    }
}
