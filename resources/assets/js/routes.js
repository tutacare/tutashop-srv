import VueRouter from 'vue-router'

let routes=[
{
	path:'/',
	component:require('./components/Main')
},
{
	path:'/login',
	component:require('./components/Login')
},
{
	path:'/dashboard',
	component:require('./components/Dashboard')
},
{
	path:'/customers',
	component:require('./components/Customers')
},
{
	path:'/items',
	component:require('./components/Items'),
	//meta: { requiresAuth: true }
},
{
	path:'/suppliers',
	component:require('./components/Suppliers')
}
,
{
	path:'/receivings',
	component:require('./components/Receivings')
},
{
	path:'/sales',
	component:require('./components/Sales')
}
]

export default new VueRouter({
	routes,
	mode: 'history'
});
