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
        <form action="">
            <div class="dash-item first-dash-item">
                <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD ITEM</h6>
                <div class="inner-item">
                    <div class="dash-form">
                        <label class="clear-top-margin"><i class="fa fa-book"></i>NAME</label>
                        <input v-model="name" type="text" placeholder="SPORTS FEES" />
                        <label><i class="fa fa-code"></i>AMOUNT</label>
                        <input v-model="amount" type="number" placeholder="GHS 20" />
                        <label><i class="fa fa-code"></i>ACADEMIC YEAR</label>
                        <select name="" id="" v-model="year" @change="getAllTerms">
                            <option>-- Select --</option>
                            <option v-for="item in getYears" :value="item.id" >{{item.name}}</option>
                        </select>
                        <label><i class="fa fa-code"></i>Term</label>
                        <select name="" v-model="term">
                            <option v-for="item in getTerms" :value="item.id" >{{item.display_name}}</option>
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
        name: "breakdown",
        data(){
            return {
                name:'',
                amount:'',
                getYears:null,
                term:'',
                getTerms:null,
                year:'',
                alert_success:false,
                alert_danger:false,
            }
        },
        mounted(){
            axios.get('/date/acade/terms').then(resp=>{
                this.getYears = resp.data;
            })
        },
        methods:{
            getAllTerms(){
                axios.get('/date/terms/'+this.year).then(resp=>{
                    this.getTerms = resp.data;
                })
            },
            attemptSave(){
                axios.post('/admin/school-details/items/save',{
                    name:this.name,amount:this.amount,year:this.year,term:this.term
                }).then(resp=>{
                    if(resp.data.status == 'success'){
                        this.alert_success = true;
                        window.scrollTo(0,0);
                        this.name = '';this.amount = '';
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
                return this.name && this.term && this.amount && this.amount > 0 && this.year && this.year !='-- Select --';
            }
        },

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