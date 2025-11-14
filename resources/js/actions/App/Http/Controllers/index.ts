import UserController from './UserController'
import AdminController from './AdminController'
import RoleController from './RoleController'
import Settings from './Settings'

const Controllers = {
    UserController: Object.assign(UserController, UserController),
    AdminController: Object.assign(AdminController, AdminController),
    RoleController: Object.assign(RoleController, RoleController),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers