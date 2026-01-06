<?php

return [

    'models' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model, but you may use whatever you like.
         *
         * The model you want to use as a permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model, but you may use whatever you like.
         *
         * The model you want to use as a role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',

        /*
         * When using the "HasTeams" trait from this package, this is the name of
         * the table that will be created to track associations between roles/permissions and teams.
         */

        'team_has_roles' => 'team_has_roles',

    ],

    'column_names' => [

        /*
         * Change this if you want to name the "model morph key" differently. The morph key
         * is used to determine which "model" has a certain permission. The "user_id" is mostly
         * just conventions, but you may change it if you like.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your teams table has a different name.
         * Basically you want the owing team mother to your roles/permissions and users tables.
         * This is just the internal Laravel polymorphic relationship name.
         */

        'team_foreign_key' => 'team_id',

        'role_pivot_key' => 'role_id', //For MySQL 8 only

        'permission_pivot_key' => 'permission_id', //For MySQL 8 only

    ],

    'roles_table_use_string_guard_id_as_primary_key' => false,

    'permissions_table_use_string_guard_id_as_primary_key' => false,

    /*
     * Set to true if the `model_has_roles` and `model_has_permissions` relations should
     * use ids as string. Defaults to the value of `app.use_ulids`.
     */

    'use_ulids_for_relation_ids' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be useful when debugging and/or custom exception handling.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be useful when debugging and/or custom exception handling.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all the permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are created/updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use
         * when caching permissions to improve performance given that
         * permissions never change during a requests lifecycle.
         *
         * If it is null, then the default cache driver will be used.
         */

        'store' => null,

    ],

    /*
     * By default all permissions will be cached for each guard to improve performance.
     * When permissions or roles are created/updated the cache is flushed automatically.
     * False this might impact performance.
     */

    'enable_caching' => true,

    'teams' => false,

    /*
     * Whether team ownership of permissions/roles is accepted in middleware.
     */

    'team_ownership_independent_of_guard' => false,

];
