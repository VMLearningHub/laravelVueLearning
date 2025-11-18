import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admins',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::index
* @see app/Http/Controllers/AdminController.php:18
* @route '/admins'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\AdminController::store
* @see app/Http/Controllers/AdminController.php:60
* @route '/admins'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admins',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\AdminController::store
* @see app/Http/Controllers/AdminController.php:60
* @route '/admins'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::store
* @see app/Http/Controllers/AdminController.php:60
* @route '/admins'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::store
* @see app/Http/Controllers/AdminController.php:60
* @route '/admins'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::store
* @see app/Http/Controllers/AdminController.php:60
* @route '/admins'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admins/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::create
* @see app/Http/Controllers/AdminController.php:50
* @route '/admins/create'
*/
createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

create.form = createForm

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
export const show = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admins/show/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
show.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return show.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
show.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
show.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
const showForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
showForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::show
* @see app/Http/Controllers/AdminController.php:93
* @route '/admins/show/{id}'
*/
showForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

/**
* @see \App\Http\Controllers\AdminController::update
* @see app/Http/Controllers/AdminController.php:109
* @route '/admins/{id}'
*/
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admins/{id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\AdminController::update
* @see app/Http/Controllers/AdminController.php:109
* @route '/admins/{id}'
*/
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::update
* @see app/Http/Controllers/AdminController.php:109
* @route '/admins/{id}'
*/
update.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\AdminController::update
* @see app/Http/Controllers/AdminController.php:109
* @route '/admins/{id}'
*/
const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::update
* @see app/Http/Controllers/AdminController.php:109
* @route '/admins/{id}'
*/
updateForm.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

update.form = updateForm

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/{id}'
*/
const destroyfabd7de695c3ef3f34666cd151b78341 = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroyfabd7de695c3ef3f34666cd151b78341.url(args, options),
    method: 'delete',
})

destroyfabd7de695c3ef3f34666cd151b78341.definition = {
    methods: ["delete"],
    url: '/admins/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/{id}'
*/
destroyfabd7de695c3ef3f34666cd151b78341.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return destroyfabd7de695c3ef3f34666cd151b78341.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/{id}'
*/
destroyfabd7de695c3ef3f34666cd151b78341.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroyfabd7de695c3ef3f34666cd151b78341.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/{id}'
*/
const destroyfabd7de695c3ef3f34666cd151b78341Form = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroyfabd7de695c3ef3f34666cd151b78341.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/{id}'
*/
destroyfabd7de695c3ef3f34666cd151b78341Form.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroyfabd7de695c3ef3f34666cd151b78341.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroyfabd7de695c3ef3f34666cd151b78341.form = destroyfabd7de695c3ef3f34666cd151b78341Form
/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/deactive/{id}'
*/
const destroyccd2b5047e92144cc3af4619d4b68f36 = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroyccd2b5047e92144cc3af4619d4b68f36.url(args, options),
    method: 'delete',
})

destroyccd2b5047e92144cc3af4619d4b68f36.definition = {
    methods: ["delete"],
    url: '/admins/deactive/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/deactive/{id}'
*/
destroyccd2b5047e92144cc3af4619d4b68f36.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return destroyccd2b5047e92144cc3af4619d4b68f36.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/deactive/{id}'
*/
destroyccd2b5047e92144cc3af4619d4b68f36.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroyccd2b5047e92144cc3af4619d4b68f36.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/deactive/{id}'
*/
const destroyccd2b5047e92144cc3af4619d4b68f36Form = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroyccd2b5047e92144cc3af4619d4b68f36.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::destroy
* @see app/Http/Controllers/AdminController.php:117
* @route '/admins/deactive/{id}'
*/
destroyccd2b5047e92144cc3af4619d4b68f36Form.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroyccd2b5047e92144cc3af4619d4b68f36.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroyccd2b5047e92144cc3af4619d4b68f36.form = destroyccd2b5047e92144cc3af4619d4b68f36Form

export const destroy = {
    '/admins/{id}': destroyfabd7de695c3ef3f34666cd151b78341,
    '/admins/deactive/{id}': destroyccd2b5047e92144cc3af4619d4b68f36,
}

/**
* @see \App\Http\Controllers\AdminController::edit
* @see app/Http/Controllers/AdminController.php:101
* @route '/admins/{id}/edit'
*/
export const edit = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: edit.url(args, options),
    method: 'put',
})

edit.definition = {
    methods: ["put"],
    url: '/admins/{id}/edit',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\AdminController::edit
* @see app/Http/Controllers/AdminController.php:101
* @route '/admins/{id}/edit'
*/
edit.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return edit.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::edit
* @see app/Http/Controllers/AdminController.php:101
* @route '/admins/{id}/edit'
*/
edit.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: edit.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\AdminController::edit
* @see app/Http/Controllers/AdminController.php:101
* @route '/admins/{id}/edit'
*/
const editForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: edit.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\AdminController::edit
* @see app/Http/Controllers/AdminController.php:101
* @route '/admins/{id}/edit'
*/
editForm.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: edit.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

edit.form = editForm

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
export const getroles = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getroles.url(options),
    method: 'get',
})

getroles.definition = {
    methods: ["get","head"],
    url: '/admins/roles',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
getroles.url = (options?: RouteQueryOptions) => {
    return getroles.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
getroles.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getroles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
getroles.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getroles.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
const getrolesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getroles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
getrolesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getroles.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\AdminController::getroles
* @see app/Http/Controllers/AdminController.php:40
* @route '/admins/roles'
*/
getrolesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: getroles.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

getroles.form = getrolesForm

const AdminController = { index, store, create, show, update, destroy, edit, getroles }

export default AdminController