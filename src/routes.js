import welcome from './components/welcome.vue';
import user from './components/user.vue';

export default[
    {path:'/',component:welcome, name:'home'},
    {path:'/home',component:welcome, name:'home'},
    {path:'/user',component:user, name:'user'},
]