<template>
    <form action="" method="post">
    <div class="panel panel-primary" v-show="show">
        <div class="panel-heading text-center">
            School Registration
        </div>
        <br>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                50%
            </div>
        </div>
            <div class="panel-body">

                <div class="">
                    <input type="text" class="" v-model="name"  placeholder="Name">
                </div>
                <div class="">
                    <input type="text" class="" v-model="email" placeholder="Email">
                </div>
                <div class="">
                    <input type="text" class="" v-model="location" placeholder="Location">
                </div>
                <div class="">
                    <input type="text" class="" v-model="contact" placeholder="Contact">
                </div>
                <div class="">
                    <input type="text" class="" v-model="alt_contact" placeholder="Other Contact">
                </div>

                <div class="">
                    <input type="text" class="" v-model="category" placeholder="Category">
                </div>
            </div>
            <div class="panel-footer">
                <div class="form-group clearfix">
                    <button class="btn btn-primary pull-right" @click.prevent="show = false" :disabled="!validate">Next</button>
                    <a href="" type="button" @click.prevent="back" class="btn btn-default pull-left">Back</a>
                </div>
            </div>

    </div>
        <div class="panel panel-primary" v-show="!show">
            <div class="panel-heading text-center">
               Your Credentials
            </div>
            <br>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                    100%
                </div>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger alert-dismissible" role="alert" v-show="success">
                    <button type="button" @click="successN" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> {{verify}}
                </div>
                <div class="">
                    <input type="text" class="" v-model="staff_name"  placeholder="Name">
                </div>
                <div class="">
                    <input type="text" class="" v-model="staff_email"  placeholder="Email">
                </div>
                <div class="">
                    <input type="password" class="" v-model="password"  placeholder="Password">
                </div>
                <div class="">
                    <input type="password" class="" v-model="password_confirmation" placeholder="Confirm Password">
                </div>

            </div>
            <div class="panel-footer">
                <div class="form-group clearfix" >
                    <button id="loadingButton" class="btn btn-primary pull-right" @click.prevent="attempRegister" :disabled="!checkPass">
                        <i class="fa"></i>
                        Register
                    </button>
                    <a href="" type="button" @click.prevent="previous" class="btn btn-default pull-left">Back</a>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
    export default {
        name: "register",
        data(){
          return {
              name:'',
              location:'',
              contact:'',
              alt_contact:'',
              category:'',
              email:'',
              password:'',
              staff_name:'',
              staff_email:'',
              password_confirmation:'',
              show:true,
              loading:false,
              success:false,
              verify:''

          }
        },
        methods:{
            back(){
                window.history.back();
            },
            previous(){
                this.show = true;
            },
            successN(){
                this.success = false;
            },
            emailIsValid(val)
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(val))
                {
                    return (true)
                }else{
                    return false;
                }

            },
            attempRegister(){
                $('#loadingButton').prop('disabled',true);
                $('#loadingButton i').addClass('fa-refresh').addClass('fa-spin');
                axios.post('/register-school',{
                    name:this.name,
                    email:this.email,
                    category:this.category,
                    alt_contact:this.alt_contact,
                    location:this.location,
                    contact:this.contact,
                    username:this.staff_name,
                    user_mail:this.staff_email,
                    password:this.password
                }).then((resp)=>{
                   if(resp.data.status != 'error'){
                       sessionStorage.setItem('message','Email Verification has been sent to your mail');
                       location.replace('/login');
                   }else if(resp.data.status == 'error'){
                       this.verify = resp.data.message;
                       this.success = true;
                       $('#loadingButton').prop('disabled',false);
                       $('#loadingButton i').removeClass('fa-refresh').removeClass('fa-spin');
                   }
                }).catch((error)=>{
                    console.log(error);
                })
            }
        },
        computed:{
            validate(){
                return this.name && this.contact && this.location && this.email && this.emailIsValid(this.email)
            },
            checkPass(){
                    return this.password && this.password_confirmation && this.password == this.password_confirmation
                        && this.emailIsValid(this.staff_email) && this.staff_name;
            }
        }
    }
</script>

<style scoped>
    input{
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
        margin-top: 6%;
    }
    .progress{
        border-radius: 0;
    }

</style>