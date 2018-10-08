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
            <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD SUBJECT</h6>
            <div class="inner-item">
                <div class="dash-form">
                    <label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
                    <input type="text" v-model="name" placeholder="Basic Mathematics" />
                    <label><i class="fa fa-code"></i>SUBJECT CODE</label>
                    <input type="text" v-model="code" placeholder="MTH101" />

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
        name: "class_course",
        data(){
            return{
                name:'',
                code:'',
                alert_success:false,
                alert_danger:false,
            }

        },
        methods:{
            attemptSave(){
                axios.post('/admin/courses',{
                    name:this.name,code:this.code,
                })
                    .then(resp=>{
                        if(resp.data.status == 'success'){
                            this.alert_success = true;
                            this.name=null;this.code=null;
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
        computed:{
            validate(){
                return this.name
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