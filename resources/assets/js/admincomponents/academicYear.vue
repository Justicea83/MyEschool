<template>
    <div class="col-sm-4">
        <div class="row">
            <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" @click="danger"  class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Could't save Academic Info
                    </div>
                </div>
            </div>
            <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" @click="success" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Academic Year Added Successfully
                    </div>
                </div>
            </div>
        </div>
        <form action="">
            <div class="dash-item first-dash-item">
                <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD ACADEMIC YEAR</h6>
                <div class="inner-item">
                    <div class="dash-form">
                        <label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
                        <select name="" v-model="name" >
                            <option>-- Select --</option>
                            <option v-for="item in years">{{item.current}}/{{item.one}}</option>
                        </select>
                        <label><i class="fa fa-code"></i>STATUS</label>
                        <select name="" v-model="status" id="">
                            <option>-- Select --</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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
        name: "academicYear",
        data(){
            return {
                name:'',
                status:'',
                alert_success:false,
                alert_danger:false,
                years:null
            }
        },
        mounted(){
            axios.get('/date/generation').then(resp=>{
                this.years = resp.data;
            })
        },
        methods:{
            attemptSave(){
                axios.post('/admin/school-details/academic-years/save',{
                    name:this.name,status:this.status
                }).then(resp=>{
                    if(resp.data.status == 'success'){
                        this.alert_success = true;
                        this.alert_danger = false;
                        window.scrollTo(0,0);
                        this.name = '';this.amount = '';
                    }else{
                        this.alert_danger = true;
                        this.alert_success = false;
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
                return this.name && this.status && this.status != '-- Select --' && this.name !='-- Select --';
            }
        },

    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }

</style>