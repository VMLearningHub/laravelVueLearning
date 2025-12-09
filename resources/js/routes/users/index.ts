import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/users',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::index
* @see app/Http/Controllers/UserController.php:24
* @route '/users'
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
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
export const userList = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: userList.url(options),
    method: 'get',
})

userList.definition = {
    methods: ["get","head"],
    url: '/users/user-list',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
userList.url = (options?: RouteQueryOptions) => {
    return userList.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
userList.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: userList.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
userList.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: userList.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
const userListForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: userList.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
userListForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: userList.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\UserController::userList
* @see app/Http/Controllers/UserController.php:29
* @route '/users/user-list'
*/
userListForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: userList.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

userList.form = userListForm

/**
* @see \App\Http\Controllers\UserController::destroy
* @see app/Http/Controllers/UserController.php:189
* @route '/users/deactive/{id}'
*/
export const destroy = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/users/deactive/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\UserController::destroy
* @see app/Http/Controllers/UserController.php:189
* @route '/users/deactive/{id}'
*/
destroy.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\UserController::destroy
* @see app/Http/Controllers/UserController.php:189
* @route '/users/deactive/{id}'
*/
destroy.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\UserController::destroy
* @see app/Http/Controllers/UserController.php:189
* @route '/users/deactive/{id}'
*/
const destroyForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\UserController::destroy
* @see app/Http/Controllers/UserController.php:189
* @route '/users/deactive/{id}'
*/
destroyForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

/**
* @see \App\Http\Controllers\UserController::countUserData
* @see app/Http/Controllers/UserController.php:117
* @route '/users/count-user-data'
*/
export const countUserData = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: countUserData.url(options),
    method: 'post',
})

countUserData.definition = {
    methods: ["post"],
    url: '/users/count-user-data',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\UserController::countUserData
* @see app/Http/Controllers/UserController.php:117
* @route '/users/count-user-data'
*/
countUserData.url = (options?: RouteQueryOptions) => {
    return countUserData.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\UserController::countUserData
* @see app/Http/Controllers/UserController.php:117
* @route '/users/count-user-data'
*/
countUserData.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: countUserData.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\UserController::countUserData
* @see app/Http/Controllers/UserController.php:117
* @route '/users/count-user-data'
*/
const countUserDataForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: countUserData.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\UserController::countUserData
* @see app/Http/Controllers/UserController.php:117
* @route '/users/count-user-data'
*/
countUserDataForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: countUserData.url(options),
    method: 'post',
})

countUserData.form = countUserDataForm

/**
* @see \App\Http\Controllers\UserController::suspendUser
* @see app/Http/Controllers/UserController.php:230
* @route '/users/suspend-user'
*/
export const suspendUser = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: suspendUser.url(options),
    method: 'post',
})

suspendUser.definition = {
    methods: ["post"],
    url: '/users/suspend-user',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\UserController::suspendUser
* @see app/Http/Controllers/UserController.php:230
* @route '/users/suspend-user'
*/
suspendUser.url = (options?: RouteQueryOptions) => {
    return suspendUser.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\UserController::suspendUser
* @see app/Http/Controllers/UserController.php:230
* @route '/users/suspend-user'
*/
suspendUser.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: suspendUser.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\UserController::suspendUser
* @see app/Http/Controllers/UserController.php:230
* @route '/users/suspend-user'
*/
const suspendUserForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: suspendUser.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\UserController::suspendUser
* @see app/Http/Controllers/UserController.php:230
* @route '/users/suspend-user'
*/
suspendUserForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: suspendUser.url(options),
    method: 'post',
})

suspendUser.form = suspendUserForm

const users = {
    index: Object.assign(index, index),
    userList: Object.assign(userList, userList),
    destroy: Object.assign(destroy, destroy),
    countUserData: Object.assign(countUserData, countUserData),
    suspendUser: Object.assign(suspendUser, suspendUser),
}

export default users