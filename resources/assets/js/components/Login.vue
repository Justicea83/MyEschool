<template>
    <form action="" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                Login
            </div>

            <div class="panel-body">
                <div class="alert alert-danger alert-dismissible" role="alert" v-show="success">
                    <button type="button" @click="successN" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> {{verify}}
                </div>
                <div class="alert alert-success alert-dismissible" role="alert" v-show="showMessage">
                    <button type="button" @click="successN" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> {{verify}}
                </div>
                <div class="">
                    <input type="text" v-show="!student" class="" v-on:keyup="show" v-model="email"  placeholder="Email">
                </div>
                <div  v-show="student">
                    <input type="text" placeholder="Username" v-model="username">
                </div>
                <div class="">
                    <input type="password" class="" v-on:keyup="show" v-model="password" placeholder="Password">
                </div>
                <div>
                    <select name="" id="" v-model="format" v-on:change="showFormat">
                        <option value="admin" selected>Admin | Guardian</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" v-model="remember"> Remember me</label>
                </div>
                <div>
                    <a href="password/reset"><p>Forgot Password?</p></a>
                </div>

            </div>
            <div class="panel-footer">
                <div class="form-group clearfix">
                    <button id="loadingButton" @click.prevent="attempLogin" :disabled="!validate" class="btn btn-primary pull-right">
                        <i class="fa"></i>
                        Login
                    </button>
                    <a href="" type="button" @click.prevent="back"  class="btn btn-default pull-left">Back</a>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
    export default {
        name: "Login",
        data(){
            return {
                email:'',
                password:'',
                success:false,
                format:'admin',
                student:false,
                username:'',
                remember:true,
                verify:'',
                showMessage:false

            }
        },
        computed:{
            validate(){
                if(!this.student)
                    return this.email && this.password && this.emailIsValid()
                else{
                    return this.username && this.password
                }
            },
            showFormat(){
                this.username = '';
                this.password = '';
                this.email = '';
                if(this.format == 'admin'){
                    this.student = false;
                    return this.student;
                }else{
                    this.student = true;
                    return this.student;
                }
            }

        },
        methods:{
            back(){
                location.replace('/')
            },
            show(){
              this.success = false;
            },
            successN(){
                this.success = false;
                this.showMessage = false
                sessionStorage.clear();
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
                $('#loadingButton').prop('disabled',true);
                $('#loadingButton i').addClass('fa-refresh').addClass('fa-spin');
                axios.post('/login-user',{
                    email:this.email,
                    password:this.password,
                    format:this.format,
                    username:this.username
                }).then((resp)=>{
                    if(resp.data.status == 'success')
                        location.replace(resp.data.url);
                    else if(resp.data.status == 'unverified'){
                        this.verify = resp.data.message;
                        this.success = true;
                        $('#loadingButton').prop('disabled',false);
                        $('#loadingButton i').removeClass('fa-refresh').removeClass('fa-spin');
                    }
                    else{
                        this.verify = 'Incorrect Email or Password';
                        this.success = true;
                        $('#loadingButton').prop('disabled',false);
                        $('#loadingButton i').removeClass('fa-refresh').removeClass('fa-spin');
                    }
                }).catch((error)=>{
                   // console.log(error);
                })
            }
        },
        mounted(){
            let item = sessionStorage.getItem('message');
            if(item != null){
                this.showMessage = true;
                this.verify = item;
            }


        }

    }
</script>

<style scoped>
    input[type=text],input[type=password],select{
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
    input:focus,select:focus{
        border-bottom: 2px solid #4286f4;
    }
    .panel{
        margin-top: 10%;
    }
</style>