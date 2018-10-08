<template>
    <div class="col-sm-4">
        <div class="row">
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
        </div>
        <form action="">
            <div class="dash-item first-dash-item">
                <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD TERM</h6>
                <div class="inner-item">
                    <div class="dash-form">
                        <label class="clear-top-margin"><i class="fa fa-book"></i>NUMBER</label>
                        <input v-model="number" type="number" placeholder="2" />
                        <label><i class="fa fa-code"></i>DISPLAY NAME</label>
                        <input v-model="name" type="text" placeholder="TERM ONE" />
                        <label><i class="fa fa-code"></i>ACADEMIC YEAR</label>
                        <select name="" id="" v-model="year">
                            <option>-- Select --</option>
                            <option v-for="item in getYears" :value="item.id">{{item.name}}</option>
                        </select>
                        <label><i class="fa fa-code"></i>STATUS</label>
                        <select name="" v-model="status" >
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
        name: "term",
        data(){
            return {
                name:'',
                year:'',
                number:'',
                status:'',

                getYears:null,
                alert_success:false,
                alert_danger:false,

            }
        },
        mounted(){
            axios.get('/date/acade/terms').then(resp=>{
                this.getYears = resp.data;
            })
            //

        },
        methods:{
            attemptSave(){
                axios.post('/admin/school-details/terms/save',{
                    name:this.name,year:this.year,number:this.number,status:this.status
                }).then(resp=>{
                    if(resp.data.status == 'success'){
                        this.alert_success = true;
                        window.scrollTo(0,0);
                        this.name = '';this.year = '';this.number='';
                    }else{
                        this.alert_danger = true;
                        console.log(resp.data.message.errorInfo)
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
                return this.name && this.year && this.number > 0 && this.year !='-- Select --'
                    && this.status != '-- Select --';
            }
        },

    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }

</style>