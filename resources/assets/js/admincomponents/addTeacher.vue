<template>
    <div>
        <div class="row">
            <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" @click="danger"  class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Could't save teacher info
                    </div>
                </div>
            </div>
            <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" @click="success" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Teacher Info Saved Successfully
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="" enctype="multipart/form-data" id="form-data">
                <div class="col-lg-12 clear-padding-xs">
                    <div class="col-md-12">
                        <div class="dash-item first-dash-item">
                            <h6 class="item-title"><i class="fa fa-user"></i>TEACHER INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>FIRST NAME</label>
                                        <input type="text" placeholder="JOHN" v-model="fname" name="firstname"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>MIDDLE NAME</label>
                                        <input type="text" placeholder="FIDLER" v-model="mname" name="middlename"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-user-circle-o"></i>LAST NAME</label>
                                        <input type="text" placeholder="DOE" v-model="lname" name="lastname"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-venus"></i>GENDER</label>
                                        <select v-model="gender" name="gender">
                                            <option>-- Select --</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-calendar"></i>DATE OF BIRTH</label>
                                        <input type="date" name="dob" v-model="dob"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="phone" v-model="phone"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" placeholder="john@pathshala.com" name="email" v-model="email"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-bell-o"></i>RELIGION</label>
                                        <select v-model="religion" name="religion">
                                            <option>-- Select --</option>
                                            <option>Buddhism</option>
                                            <option>Islamic</option>
                                            <option>Christian</option>
                                            <option>Hinduism</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-file-picture-o"></i>UPLOAD PHOTO</label>
                                        <input type="file" placeholder="90890" name="avatar" ref="file" v-on:change="handleFileUpload()"/>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-home"></i>CONTACT INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-home"></i>ADDRESS 1</label>
                                        <input type="text" placeholder="H/N 42 Street# 10" name="contact_address" v-model="c_address1"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-home"></i>ADDRESS 2</label>
                                        <input type="text" placeholder="H/N 42 Street# 10" name="contact_address1"  v-model="c_address2"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-flag"></i>COUNTRY</label>
                                        <select v-model="c_country" name="country">
                                            <option>-- Select --</option>
                                            <option value="Ghana">Ghana</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-id-card"></i>REGION</label>
                                        <select v-model="c_state" name="state">
                                            <option>-- Select --</option>
                                            <option>Western Region</option>
                                            <option>Ashanti Region</option>
                                            <option>Eastern Region</option>
                                            <option>Northern Region</option>
                                            <option>Upper-East Region</option>
                                            <option>Upper-West Region</option>
                                            <option>Brong-Ahafo Region</option>
                                            <option>Central Region</option>
                                            <option>Volta Region</option>
                                            <option>Greater Accra Region</option>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-code"></i>ZIP</label>
                                        <input type="text" placeholder="90890" name="zip" v-model="c_zip"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-phone"></i>PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="contact_phone" v-model="c_phone"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-phone"></i>ALTERNATE PHONE #</label>
                                        <input type="text" placeholder="1234567890" name="contact_phone1" v-model="c_alt_phone"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label><i class="fa fa-envelope-o"></i>EMAIL</label>
                                        <input type="text" placeholder="john@pathshala.com" name="contact_mail" v-model="c_mail"/>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="dash-item">
                            <h6 class="item-title"><i class="fa fa-book"></i>ACADEMIC INFO</h6>
                            <div class="inner-item">
                                <div class="dash-form">
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-graduation-cap"></i>HIGHEST DEGREE</label>
                                        <input type="text" placeholder="PhD" name="degree" v-model="a_degree"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-building"></i>UNIVERSITY/COLLEGE</label>
                                        <v-select v-model="a_uni" label="name"  :options="universities">
                                        </v-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-calaendar"></i>YEAR PASSED</label>
                                        <input v-model="a_year_passed" type="number"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="clear-top-margin"><i class="fa fa-puzzle-piece"></i>CGPA</label>
                                        <input type="text" placeholder="08.65" name="gpa" v-model="a_gpa"/>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-12">
                                        <a @click.prevent="attemptSave" :class="{'disabled':!validate}" class="btn btn-success">
                                            <i class="fa fa-paper-plane"></i> SAVE
                                        </a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import VSelect from 'vue-select';
    export default {
        name: "addTeacher",
        components:{
            VSelect
        },
        data(){
            return {
                fname:'',
                mname:'',
                lname:'',
                gender:'',
                dob:'',
                phone:'',
                email:'',
                religion:'',
                avatar:'',
                c_address1:'',
                c_address2:'',
                c_country:'',
                c_state:'',
                c_zip:'',
                c_phone:'',
                c_alt_phone:'',
                c_mail:'',
                a_degree:'',
                a_uni:'',
                a_year_passed:'',
                a_gpa:'',
                alert_danger:false,
                alert_success:false,
                universities:null,
                uni_years:null

            }
        },
        methods:{
            danger(){
                this.alert_danger = false;
            },
            success(){
                this.alert_success = false;
            },
            handleFileUpload(){
                this.avatar = this.$refs.file.files[0];
            },
            attemptSave(){
                axios.post('/admin/teachers',{
                    firstname:this.fname,middlename:this.mname,lastname:this.lname,gender:this.gender,dob:this.dob
                    ,phone:this.phone,email:this.email,religion:this.religion,avatar:this.avatar,
                    c_address:this.c_address1,c_address1:this.c_address2,country:this.c_country,zip:this.c_zip,
                    c_phone:this.c_phone,c_phone1:this.c_alt_phone,c_mail:this.c_mail,state:this.c_state,
                    degree:this.a_degree,uni:this.a_uni,year:this.a_year_passed,gpa:this.a_gpa
                }).then((resp)=>{
                    this.alert_success = true;
                    //setting to null
                    this.fname = '';this.mname = '',this.lname='';this.gender='';this.dob='';this.phone='';
                    this.email='';this.religion='';this.avatar = '';this.c_address1='';this.c_address2='';
                    this.country='';this.zip='';this.c_zip='';this.c_phone='';this.c_alt_phone = '';this.c_mail='';
                    this.c_state='';this.a_degree='';this.a_uni='';this.a_year_passed='';this.a_gpa='';this.c_country ='';
                    if(this.alert_danger){
                        this.alert_danger = false;
                    }
                    window.scrollTo(0,0);
                }).catch((error)=>{
                    this.alert_danger = true;
                    if(this.alert_success){
                        this.alert_success = false;
                    }
                    window.scrollTo(0,0);
                })
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

        },
        computed:{
            validate(){
                return this.emailIsValid(this.email) && this.emailIsValid(this.c_mail) && this.email
                && this.fname && this.lname;
            }
        },
        mounted(){
            axios.get('/date/all/universities')
                .then(resp=>{
                    this.universities = resp.data;
                });
        }

    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }
</style>