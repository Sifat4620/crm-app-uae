<?php

namespace App\Enum;

enum Permissions: string
{
    case ProductShow   = 'product.show';
    case ProductCreate = 'product.create';
    case ProductEdit   = 'product.edit';
    case ProductDelete = 'product.delete';

    case ProductCategoryShow   = 'product.category.show';
    case ProductCategoryCreate = 'product.category.create';
    case ProductCategoryEdit   = 'product.category.edit';
    case ProductCategoryDelete = 'product.category.delete';

    case BillingCycleShow   = 'billing-cycle.show';
    case BillingCycleCreate = 'billing-cycle.create';
    case BillingCycleEdit   = 'billing-cycle.edit';
    case BillingCycleDelete = 'billing-cycle.delete';

    case TicketShow   = 'ticket.show';
    case TicketCreate = 'ticket.create';

    case RoleShow   = 'role.show';
    case RoleCreate = 'role.create';
    case RoleEdit   = 'role.edit';
    case RoleDelete = 'role.delete';
}
