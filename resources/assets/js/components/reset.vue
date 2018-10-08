<template>
    <form action="" method="post" >
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                Reset Form
            </div>

            <div class="panel-body">
                <div class="alert alert-danger alert-dismissible" role="alert" v-show="success">
                    <button type="button" @click="success" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> An Error Occured
                </div>
                <div class="">
                    <input type="password" v-on:changed="focus" class="" v-model="password"  placeholder="Password">
                </div>
                <div class="">
                    <input type="password" class="" v-model="password_confirmation" placeholder="Confirm Password">
                </div>

            </div>
            <div class="panel-footer">
                <div class="form-group clearfix">
                    <button @click.prevent="attempLogin" :disabled="!validate" class="btn btn-primary pull-right">Send</button>
                    <a href="" type="button" @click.prevent="back"  class="btn btn-default pull-left">Back</a>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
    export default {
        name: "ResetForm",
        data(){
            return {
                email:'',
                success:false,
                password:'',
                password_confirmation:'',
                token:''

            }
        },
        methods:{
            back(){
                location.replace('/')
            },
            show(){
                this.success = false;
            },
            focus(){
                this.success = false;
            }
            ,
            attempLogin(){
                let tokens = window.location.pathname.split("/");
                this.token = tokens[3];
                axios.post('/password/reset',{
                    token:this.token,password:this.password
                }).then((resp)=>{
                    if(resp.data.length > 0)
                        if(resp.status == 200){
                            location.replace(resp.data);
                        }else{
                        this.status = true;
                        }
                }).catch((error)=>{
                    console.log(error);
                })
            },
        },
        computed:{
            validate(){
                return this.password && this.password == this.password_confirmation;
            },

        }
    }
</script>

<style scoped>
    input[type=text],input[type=password]{
        border: none;
        background: #fff;
        border-bottom: 2px solid #e8ebed;
        box-shadow: none;
        color: #999;
        height: 44px;
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 25px;
        padding: 6px 12px 6px 2px;
        border-radius: 0;
        outline: none !important;
        width: 100%;
    }
    input:focus{
        border-bottom: 2px solid #4286f4;
    }
    .panel{
        margin-top: 10%;
    }
</style>