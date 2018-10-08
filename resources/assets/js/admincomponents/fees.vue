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
                <h6 class="item-title"><i class="fa fa-plus-circle"></i>ADD FEES</h6>
                <div class="inner-item">
                    <div class="dash-form">
                        <label class="clear-top-margin"><i class="fa fa-book"></i>CLASSES</label>
                        <v-select multiple v-model="classnames" label="name"  :options="getClasses">
                        </v-select>
                        <br>
                        <label class="clear-top-margin"><i class="fa fa-book"></i>FEES BREAKDOWN</label>
                        <v-select multiple v-model="items" label="name"  :options="getBreakdown">
                        </v-select>

                        <label><i class="fa fa-code"></i>ACADEMIC YEAR</label>
                        <select name="" id="" v-model="year" @change="getAllTerms">
                            <option>-- Select --</option>
                            <option v-for="item in getYears" :value="item.id" >{{item.name}}</option>
                        </select>
                        <label><i class="fa fa-code"></i>Term</label>
                        <select name="" v-model="term">
                            <option v-for="item in getTerms" :value="item.id" :key="item.id">{{item.display_name}}</option>
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
    import VSelect from 'vue-select';
    export default {
        name: "fees",
        components:{
          VSelect
        },
        data(){
            return {
                items:[],
                classnames:[],
                getYears:null,
                term:'',
                getTerms:null,
                year:'',
                getClasses:null,
                getBreakdown:null,
                alert_success:false,
                alert_danger:false,
            }
        },
        mounted(){
            axios.get('/date/acade/terms').then(resp=>{
                this.getYears = resp.data;
            })
            axios.get('/date/classes/show-all').then(resp=>{
                this.getClasses = resp.data;
            })
            axios.get('/date/items/show-all').then(resp=>{
                this.getBreakdown = resp.data;
            })

        },
        methods:{
            getAllTerms(){
                axios.get('/date/terms/'+this.year).then(resp=>{
                    this.getTerms = resp.data;
                })
            },
            attemptSave(){
                axios.post('/admin/school-details/fees/save',{
                    items:this.items,year:this.year,term:this.term,classes:this.classnames
                }).then(resp=>{
                    if(resp.data.status == 'success'){
                        this.alert_success = true;
                        this.classnames=null;this.items=null;
                        window.scrollTo(0,0);
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
                return this.items && this.term  && this.year && this.classnames;
            },

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