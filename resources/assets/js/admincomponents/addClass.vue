<template>
    <div class="col-sm-4">
        <div class="row">
            <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" @click="danger"  class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Could't save class info
                    </div>
                </div>
            </div>
            <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" @click="success" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Class Added Successfully
                    </div>
                </div>
            </div>
        </div>
        <form action="">
            <div class="dash-item first-dash-item">
                <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD CLASS</h6>
                <div class="inner-item">
                    <div class="dash-form">
                        <label class="clear-top-margin"><i class="fa fa-book"></i>CLASS</label>
                        <input v-model="name" type="text" placeholder="5 STD" />
                        <label><i class="fa fa-code"></i>CLASS CODE</label>
                        <input v-model="code" type="text" placeholder="PTH05" />
                        <label><i class="fa fa-user-secret"></i>CLASS TEACHER</label>
                        <select v-model="teacher">
                            <option>-- Select --</option>
                            <option v-for="teachers in getTeachers" :value="teachers.id">{{teachers.fname}} {{teachers.lname}}</option>
                        </select>
                        <label><i class="fa fa-info-circle"></i>DESCRIPTION</label>
                        <textarea v-model="description" placeholder="Enter Description Here"></textarea>
                        <div>
                            <a href="#" @click.prevent="attemptSave" :class="{'disabled':!validate}"><i class="fa fa-paper-plane"></i> CREATE</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "addClass",
        data(){
            return {
                name:'',
                code:'',
                teacher:'',
                description:'',
                getTeachers:null,
                getTable:null,
                alert_success:false,
                alert_danger:false,
            }
        },
        mounted(){
            axios.get('/teachers/endpoint').then(resp=>{
                this.getTeachers = resp.data;
            });


        },
        methods:{
            attemptSave(){
                axios.post('/admin/classes',{
                    name:this.name,code:this.code,teacher:this.teacher,description:this.description
                }).then(resp=>{
                    if(resp.data.status == 'success'){
                        this.alert_success = true;
                        window.scrollTo(0,0);
                        this.name = '';this.code = '';
                    }else{
                        this.alert_danger = true;
                    }
                }).catch(error=>{

                })
            },
            danger(){
                this.alert_danger = false;
            },
            success(){
                this.alert_success = false;
            },


        },
        computed:{
            validate(){
                return this.name && this.teacher ;
            }
        },

    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }

</style>