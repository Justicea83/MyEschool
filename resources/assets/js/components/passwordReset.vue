<template>
    <form action="" method="post" >
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                Reset Password
            </div>

            <div class="panel-body">
                <div class="alert alert-success alert-dismissible" role="alert" v-show="success">
                    <button type="button" @click="success" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Sucess!</strong> Please Check Your Email
                </div>
                <div class="">
                    <input type="text" v-on:changed="focus" class="" v-on:keyup="show" v-model="email"  placeholder="Email">
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
        name: "Reset",
        data(){
            return {
                email:'',
                success:false

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
              this.success = true;
            },
            emailIsValid()
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))
                {
                    return (true)
                }else{
                    return false;
                }

            },
            attempLogin(){
                axios.post('/password/email',{
                    email:this.email,
                }).then((resp)=>{
                    this.email = '';
                    if(resp.status == 200)
                        this.success = true;
                }).catch((error)=>{
                    console.log(error);
                })
            }
        },
        computed:{
            validate(){
                return this.email && this.emailIsValid();
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