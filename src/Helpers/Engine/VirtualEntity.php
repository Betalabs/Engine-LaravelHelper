<?php

namespace Betalabs\LaravelHelper\Helpers\Engine;

use Betalabs\LaravelHelper\Models\EngineVirtualEntity;
use Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity as VirtualEntityType;
use Betalabs\LaravelHelper\Scopes\Tenant;
use Illuminate\Contracts\Auth\Authenticatable;

class VirtualEntity
{
    /**
     * Return a virtual-entity resource
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $tenant
     * @param \Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity $type
     *
     * @return string
     */
    public static function resource(
        Authenticatable $tenant,
        VirtualEntityType $type
    ): string {
        $virtualEntity = EngineVirtualEntity::query()
            ->withoutGlobalScope(Tenant::class)
            ->where('tenant_id', $tenant->getAuthIdentifier())
            ->where('type_id', $type->getValue())
            ->first();

        return "virtual-entities/{$virtualEntity->code}/records";
    }
}