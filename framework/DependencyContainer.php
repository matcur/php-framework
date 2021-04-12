<?php

namespace Framework;

use Exception;
use Framework\Support\Collection;

class DependencyContainer
{
    /**
     * @var Collection
     */
    private $singletons;

    /**
     * @var Collection
     */
    private $transients;

    /**
     * @var Collection
     */
    private $resolvedSingletons;

    public function __construct()
    {
        $this->singletons = new Collection();
        $this->transients = new Collection();
        $this->resolvedSingletons = new Collection();
    }

    /**
     * @throws Exception
     */
    public function addSingleton(string $name, callable $resolve)
    {
        $this->ensureFreeDependencyName($name);

        $this->singletons->put($name, $resolve);
    }

    /**
     * @throws Exception
     */
    public function addTransient(string $name, callable $resolve)
    {
        $this->ensureFreeDependencyName($name);

        $this->transients->put($name, $resolve);
    }

    public function resolve(string $name)
    {
        $resolvedSingletons = $this->resolvedSingletons;
        if ($resolvedSingletons->hasKey($name))
            return $resolvedSingletons->get($name);

        if ($this->singletons->hasKey($name))
        {
            $resolve = $this->singletons->get($name)();

            $resolvedSingletons->put($name, $resolve);

            return $resolve;
        }

        if ($this->transients->hasKey($name))
            return $this->transients->get($name)();

        throw new Exception(
            "Can not resolve $name dependency"
        );
    }

    /**
     * @throws Exception
     */
    private function ensureFreeDependencyName(string $name)
    {
        if ($this->singletons->hasKey($name))
            throw new Exception(
                "Singleton dependency with name $name already added"
            );

        if ($this->transients->hasKey($name))
            throw new Exception(
                "Transient dependency with name $name already added"
            );
    }
}