import Cookies from 'js-cookie'
import store from "../store";
import axios from 'axios';

const AuthenticatedLayout = () => import('../layouts/Authenticated.vue')
const AuthenticatedUser = () => ('../layouts/Usuarios.vue')
const GuestLayout = () => import('../layouts/Guest.vue');
const RecetasList = () => import('../views/recetas/index.vue');
const RecetasCreate = () => import('../views/recetas/create.vue');
const RecetasDetalle = () => import('../views/recetas/detalle.vue');
const FavoritosList = () => import('../views/favoritos/index.vue');
const RecetasListAdmin = () => import('../views/admin/recetas/Index.vue');
const RecetasCreateAdmin = () => import('../views/admin/recetas/Create.vue');
const RecetasUpdateAdmin = () => import('../views/admin/recetas/Update.vue');
const ComentList = () => import('../views/comentarios/Index.vue');
const PlanSemanal = () => import('../views/planSemanal/index.vue');
const ListaCompra = () => import('../views/listaCompra/index.vue');
const ComentListAdmin = () => import('../views/admin/comentarios/Index.vue');
const ComentCreate = () => import('../views/comentarios/Create.vue');
const comentAdminUpdate = () => import('../views/admin/comentarios/Update.vue');
const IngredientesAdminList = () => import('../views/admin/ingredientes/Index.vue');

function requireLogin(to, from, next) {
    let isLogin = false;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next()
    } else {
        next('/login')
    }
}

function guest(to, from, next) {
    let isLogin;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next('/')
    } else {
        next()
    }
}

function rolAdmin(to, from, next){
    axios.get('/api/user/roles', {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        }
    }).then(response => {
        let rol = response.data.roles;
        console.log(response);
        if(rol.includes('admin')){
            next();
        }else{
            next('/');
        }
    }).catch(error => {
        console.error('Error al obtener los roles: ', error);
        next('/');
    })
}

export default [
    {
        path: '/',
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [

            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
            },
            {
                path: 'posts',
                name: 'public-posts.index',
                component: () => import('../views/posts/index.vue'),
            },
            {
                path: 'posts/:id',
                name: 'public-posts.details',
                component: () => import('../views/posts/details.vue'),
            },
            {
                path: 'category/:id',
                name: 'category-posts.index',
                component: () => import('../views/category/posts.vue'),
            },
            {
                path: 'login',
                name: 'auth.login',
                component: () => import('../views/login/Login.vue'),
                beforeEnter: guest,
            },
            {
                path: 'register',
                name: 'auth.register',
                component: () => import('../views/register/index.vue'),
                beforeEnter: guest,
            },
            {
                path: 'forgot-password',
                name: 'auth.forgot-password',
                component: () => import('../views/auth/passwords/Email.vue'),
                beforeEnter: guest,
            },
            {
                path: 'reset-password/:token',
                name: 'auth.reset-password',
                component: () => import('../views/auth/passwords/Reset.vue'),
                beforeEnter: guest,
            },
            {
                name: 'recetas',
                path: 'recetas',
                meta: { breadCrumb: 'Recetas' },
                children: [
                    {
                        name: 'recetas.index',
                        path: '',
                        component: RecetasList,
                        meta: { breadCrumb: 'Listado de recetas' }
                    },
                    {
                        name: 'recetas.create',
                        path: 'create',
                        component: RecetasCreate,
                        meta: { breadCrumb: 'Crear recetas' },
                        beforeEnter: requireLogin
                    },
                    {
                        name: 'recetas.detalle',
                        path: 'detalle/:id',
                        component: RecetasDetalle,
                        meta: { breadCrumb: 'Detalles recta' }
                    }
                ]
            },
            {
                name: 'comentarios',
                path: 'comentarios',
                meta: { breadCrumb: 'comentarios' },
                children: [
                    {
                        name: 'comentarios.index',
                        path: 'comentarios/:id',
                        component: ComentList,
                        meta: { breadCrumb: 'Listado de comentarios de la receta' }
                    },
                    {
                        name: 'comentarios.create',
                        path: 'create/:id',
                        component: ComentCreate,
                        meta: { breadCrumb: 'Crear comentarios' },
                        beforeEnter: requireLogin
                    },
                ]
            },
        ]
    },
    {
        path: '/user',
        component: AuthenticatedLayout,
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Panel de Control' },
        children: [
            {
                name: 'admin.index',
                path: '',
                component: () => import('../views/admin/index.vue'),
                meta: { breadCrumb: 'Admin' }
            },
            {
                name: 'profile.index',
                path: 'profile',
                component: () => import('../views/admin/profile/index.vue'),
                meta: { breadCrumb: 'Perfil' }
            },
            {
                name: 'recetasAdmin',
                path: 'recetasAdmin',
                meta: { breadCrumb: 'Recetas' },
                children: [
                    {
                        name: 'recetasAdmin.index',
                        path: '',
                        component: RecetasListAdmin,
                        meta: { breadCrumb: 'Listado recetas' }
                    },
                    {
                        name: 'recetasAdmin.create',
                        path: 'create',
                        component: RecetasCreateAdmin,
                        meta: { breadCrumb: 'Crear receta' }
                    },
                    {
                        name: 'recetasAdmin.update',
                        path: 'update/:id',
                        component: RecetasUpdateAdmin,
                        meta: { breadCrumb: 'Actualizar receta' }
                    }
                ]
            },
            {
                name: 'comentAdmin',
                path: 'comentAdmin',
                meta: { breadCrumb: 'Comentarios' },
                children: [
                    {
                        name: 'comentAdmin.index',
                        path: '',
                        component: ComentListAdmin,
                        meta: { breadCrumb: 'Listado comentarios' }
                    },
                    {
                        name: 'comentAdmin.update',
                        path: 'update/:id',
                        component: comentAdminUpdate,
                        meta: { breadCrumb: 'Actualizar comentarios' }
                    }
                ]
            },
            {
                name: 'ingredientesAdmin',
                path: 'ingredientesAdmin',
                meta: { breadCrumb: 'Ingredientes' },
                children: [
                    {
                        name: 'ingredientesAdmin.index',
                        path: '',
                        component: IngredientesAdminList,
                        meta: { breadCrumb: 'Listado ingredientes' }
                    },
                ]
            },
            {
                name: 'Plan Semanal',
                path: 'PlanSemanal',
                meta: { breadCrumb: 'Plan Semanal' },
                component: PlanSemanal
            },
            {
                name: 'ListadelaCompra',
                path: 'ListaCompra',
                meta: { breadCrumb: 'Lista de la Compra' },
                component: ListaCompra
            },
            {
                name: 'Favoritos',
                path: 'Favoritos',
                meta: {
                    breadCrumb: 'Tus recetas Favoritas'
                },
                component: FavoritosList
            },
        ]
    },
    {
        path: '/admin',
        component: AuthenticatedLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: rolAdmin,
        meta: { breadCrumb: 'Panel de Control' },
        children: [
            {
                name: 'categories',
                path: 'categories',
                meta: { breadCrumb: 'Categories' },
                children: [
                    {
                        name: 'categories.index',
                        path: '',
                        component: () => import('../views/admin/categories/Index.vue'),
                        meta: { breadCrumb: 'View category' }
                    },
                    {
                        name: 'categories.create',
                        path: 'create',
                        component: () => import('../views/admin/categories/Create.vue'),
                        meta: {
                            breadCrumb: 'Add new category',
                            linked: false,
                        }
                    },
                    {
                        name: 'categories.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/categories/Edit.vue'),
                        meta: {
                            breadCrumb: 'Edit category',
                            linked: false,
                        }
                    }
                ]
            },

            {
                name: 'permissions',
                path: 'permissions',
                meta: { breadCrumb: 'Permisos' },
                children: [
                    {
                        name: 'permissions.index',
                        path: '',
                        component: () => import('../views/admin/permissions/Index.vue'),
                        meta: { breadCrumb: 'Permissions' }
                    },
                    {
                        name: 'permissions.create',
                        path: 'create',
                        component: () => import('../views/admin/permissions/Create.vue'),
                        meta: {
                            breadCrumb: 'Create Permission',
                            linked: false,
                        }
                    },
                    {
                        name: 'permissions.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/permissions/Edit.vue'),
                        meta: {
                            breadCrumb: 'Permission Edit',
                            linked: false,
                        }
                    }
                ]
            },

            //TODO Organizar rutas
            {
                name: 'roles.index',
                path: 'roles',
                component: () => import('../views/admin/roles/Index.vue'),
                meta: { breadCrumb: 'Roles' }
            },
            {
                name: 'roles.create',
                path: 'roles/create',
                component: () => import('../views/admin/roles/Create.vue'),
                meta: { breadCrumb: 'Create Role' }
            },
            {
                name: 'roles.edit',
                path: 'roles/edit/:id',
                component: () => import('../views/admin/roles/Edit.vue'),
                meta: { breadCrumb: 'Role Edit' }
            },
            {
                name: 'users.index',
                path: 'users',
                can: 'user-list',
                component: () => import('../views/admin/users/Index.vue'),
                meta: { breadCrumb: 'Users' }
            },
            {
                name: 'users.create',
                path: 'users/create',
                component: () => import('../views/admin/users/Create.vue'),

                meta: { breadCrumb: 'Add New' }
            },
            {
                name: 'users.edit',
                path: 'users/edit/:id',
                component: () => import('../views/admin/users/Edit.vue'),
                meta: { breadCrumb: 'User Edit' }
            },
        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
];
