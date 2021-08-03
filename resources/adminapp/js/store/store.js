import Vue from 'vue'
import Vuex from 'vuex'

import Alert from './modules/alert'
import I18NStore from './modules/i18n'

import PermissionsIndex from './cruds/Permissions'
import PermissionsSingle from './cruds/Permissions/single'
import RolesIndex from './cruds/Roles'
import RolesSingle from './cruds/Roles/single'
import UsersIndex from './cruds/Users'
import UsersSingle from './cruds/Users/single'
import CompaniesIndex from './cruds/Companies'
import CompaniesSingle from './cruds/Companies/single'
import EmployeesIndex from './cruds/Employees'
import EmployeesSingle from './cruds/Employees/single'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        I18NStore,
        PermissionsIndex,
        PermissionsSingle,
        RolesIndex,
        RolesSingle,
        UsersIndex,
        UsersSingle,
        CompaniesIndex,
        CompaniesSingle,
        EmployeesIndex,
        EmployeesSingle
    },
    strict: debug
})