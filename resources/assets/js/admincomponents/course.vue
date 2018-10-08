<template>
    <div class="col-sm-4">
        <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" @click="danger"  class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Could't save item info
                </div>
            </div>
        </div>
        <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" @click="success" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Items Added Successfully
                </div>
            </div>
        </div>
        <div class="dash-item first-dash-item">
            <h6 class="item-title"><i class="fa fa-plus-circle"></i>PAIR TEACHERS AND COURSES</h6>
            <div class="inner-item">
                <div class="dash-form">
                    <label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
                    <select name="" id="" v-model="name">
                        <option value=""></option>
                        <option value="" v-for="val in getCourses" :value="val.id" :key="val.id">{{val.name}}</option>
                    </select>
                    <label><i class="fa fa-code"></i>CLASS</label>
                    <select name="" id="" v-model="class_name">
                        <option value=""></option>
                        <option value="" v-for="val in allClasses" :value="val.id" :key="val.id">{{val.name}}</option>
                    </select>
                    <label><i class="fa fa-code"></i>TEACHER</label>
                    <select name="" id="" v-model="teacher_name">
                        <option value=""></option>
                        <option value="" :value="item.id" :key="item.id" v-for="item in allTeachers">
                            {{item.fname}} {{item.lname}}
                        </option>
                    </select>
                    <div>
                        <a href="#" @click="attemptSave" :class="{'disabled':!validate}"><i class="fa fa-paper-plane"></i> CREATE</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>

<script>
    import VSelect from 'vue-select';
    export default {
        components:{
            VSelect
        },
        name: "course",
        data(){
            return{
                allClasses:null,
                class_name:'',
                allTeachers:null,
                teacher_name:'',
                name:'',
                getCourses:null,
                alert_success:false,
                alert_danger:false,
            }

        },
        methods:{
          attemptSave(){
              axios.post('/admin/class_courses',{
                  name:this.name,class_id:this.class_name,teacher_id:this.teacher_name
              })
                  .then(resp=>{
                      if(resp.data.status == 'success'){
                          this.alert_success = true;
                          this.name=null;this.teacher_name=null;this.class_name=null;
                          window.scrollTo(0,0);
                      }else{
                          this.alert_danger = true;
                      }
                  })
          },
            danger(){
                this.alert_danger = false;
            },
            success(){
                this.alert_success = false;
            },
        },
        mounted(){
            axios.get('/date/classes/show-all')
                .then(data=>{
                    this.allClasses = data.data;
                });
            axios.get('/teachers/endpoint')
                .then(data=>{
                    this.allTeachers = data.data;
                });
            axios.get('/date/courses/show-all')
                .then(resp=>{
                    this.getCourses = resp.data.data;
                })
        },
        computed:{
            validate(){
                return this.class_name && this.name && this.teacher_name;
            }
        }
    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }
    .cColor{
        color: #2ab27b;
    }
</style>