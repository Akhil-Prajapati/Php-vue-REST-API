let v1 = new Vue({
    el: '#root',
    data:{
        name:'weack up',
        website: "https://playvalorahttpsnt.com/en-us/",
        greencolor: '<style>.red{color:red}</style><div class="red">this  color is red</div>'},
    methods:{
        calldiv: function(time){
            return'good'+time +' '+ this.name;
        }
}});
let v2 = new Vue({
    el: '#calculate',
    data:{
        age: 20,
        X: 0,
        Y: 0,
        L: '',
        name: '',
        s:'',
        available:false,
        nearby:false,
        error:false,
        success:false,
        arrays:['oneplus','iphone','nokia','poco'],
        objects:[
            {name:'pitter',age:24},
            {name:'clay',age:34},
            {name:'nova',age:21}
        ],
        health:100,
        ended:false,
        output:''

    },
    methods:{
        add: function(inc){
            this.age+= inc;
        },
        sub: function(dec){
            this.age-= dec;
        },
        upadteXY: function(event) {
            this.X=event.offsetX;
            this.Y=event.offsetY;
        },
        send: function(){
            alert('youclicked on it');
        },
        lenth: function() {
            this.L++;
        },
        // addtos: function(){
        //     return this.s +this.age;
        // }
        punch: function(){
            this.health-=10;
            if(this.health<=0){
                this.ended=true;
            }
        },
        restart: function(){
            this.health=100;
            this.ended=false;
        },
        findfood: function(){
            this.output=this.$refs.food.value;
        }



    }, 
    computed:{
         addtos: function(){
            return this.s +this.age;
        },
        compClass: function() {
            return{
                available:this.available,
                nearby:this.nearby
            }
        }

    }
});
var data = {
    name:'papa'
}
Vue.component('greeting',{
    template:'  <p>Hy there,i am {{name}},<button v-on:click="changename">change name</button><p>',
    data: function(){
        return data;
        // return{
        //     name:'papa'
        // }
    },
    methods:{
        changename: function(){
            this.name='mom'
        }
    }
});

new Vue({
    el: '#vue-app-one'
});

new Vue({
    el: '#vue-app-two'
});