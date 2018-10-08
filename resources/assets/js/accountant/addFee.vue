<template>
    <div class="row">
        <div class="row">
            <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" @click="danger"  class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Could't save fee info
                    </div>
                </div>
            </div>
            <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" @click="success" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Fee Saved Successfully
                    </div>
                </div>
            </div>
        </div>
        <form method="post"  enctype="multipart/form-data" >
            <div class="col-lg-12 clear-padding-xs">
                <div class="col-md-12">
                    <div class="dash-item first-dash-item">
                        <h6 class="item-title"><i class="fa fa-book"></i>STUDENT INFO</h6>
                        <div class="inner-item">
                            <div class="dash-form">
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-calendar"></i>Class</label>
                                    <!--<v-select   label="name"  :options="getClasses">
                                    </v-select>-->
                                    <select @change="getPartStud" name="" v-model="classnames" id="">
                                        <option v-for="item in getClasses" :value="item.id">{{item.name}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-calendar"></i>Student</label>
                                    <v-select label="fullname" v-model="student"  :options="getStudents">
                                    </v-select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="dash-item">
                        <h6 class="item-title"><i class="fa fa-book"></i>PAYMENT DETAILS</h6>
                        <div class="inner-item">
                            <div class="dash-form">
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-building"></i>Payment Mode</label>
                                    <select @change="changeStatus" v-model="statusOption">
                                        <option value="cheque">Cheque</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-calendar"></i>Bank Name</label>
                                    <input type="text" placeholder="" v-model="bank_name"  :disabled="status"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-calendar"></i>Branch </label>
                                    <input type="text" placeholder="" v-model="branch"  :disabled="status"/>
                                </div>
                                <div class="col-sm-3">
                                    <label class="clear-top-margin"><i class="fa fa-calendar"></i> Cheque No.</label>
                                    <input type="text" placeholder="" v-model="cheque_no"  :disabled="status"/>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-3">
                                    <label ><i class="fa fa-calendar"></i>Remarks </label>
                                    <input type="text" placeholder="" v-model="remarks" />
                                </div>
                                <div class="col-sm-3  ">
                                    <label ><i class="fa fa-calendar"></i>Cheque Date </label>
                                    <input type="date" placeholder="" v-model="cheque_date"  :disabled="status"/>
                                </div>
                                <div class="col-sm-3  ">
                                    <label ><i class="fa fa-calendar"></i>Amount</label>
                                    <input placeholder="" type="number" v-model="amount"/>
                                </div>
                                <div class="col-sm-3  ">
                                    <label ><i class="fa fa-calendar"></i>Previous Balance</label>
                                    <input placeholder="" id="previous" name="cheque_date" :value="previous" disabled/>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-sm-3  ">
                                    <label ><i class="fa fa-calendar"></i>Fee Payable</label>
                                    <input placeholder="" :value="amount_payable"  disabled/>
                                </div>

                                <div class="col-sm-3  ">
                                    <label ><i class="fa fa-calendar"></i>Balance</label>
                                    <input placeholder="" name="cheque_date" v-model="balance"  disabled/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <a type="submit" @click="attemptSave"  :class="{'disabled':!validate}">
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
</template>

<script>
    import VSelect from 'vue-select';
    export default {
        components:{
            VSelect
        },
        name: "addFee",
        data(){
            return {
                status:false,cheque_no:null,
                statusOption:'cheque',branch:null,cheque_date:null,
                getClasses:null,amount:null,balance:null,remarks:null,
                classnames:null,
                getStudents:null,
                amount_payable:null,
                student:null,term:null,academic:null,
                bank_name:null,previous:0, alert_success:false,
                alert_danger:false,allPayables:[]
            }
        },
        methods:{
            attemptSave(){
                this.balance = this.amount_payable - this.amount + this.previous;
                axios.post('/accountant/fees-collection/save',{
                    cheque_no:this.cheque_no,payment_mode:this.statusOption,
                    branch:this.branch,cheque_date:this.cheque_date,amount:this.amount,balance:this.balance,
                    remarks:this.remarks,class_id:this.classnames,amount_payable:this.amount_payable,
                    student_id:this.student.id,bank_name:this.bank_name,
                    term_id:this.term,academic_id:this.academic,previous:this.previous
                })
                    .then(resp=>{
                        if(resp.data.status == 'success'){
                            this.alert_success = true;

                            this.cheque_no=null;
                            this.branch = null;
                            this.cheque_date=null;
                            this.amount=null;
                            this.balance=0;
                            this.balance=null;
                            this.classnames=0;
                            this.amount_payable=null;
                            this.student_id=null;
                            this.bank_name=null;
                            window.scrollTo(0,0);
                        }else{
                            this.alert_danger = true;
                        }
                    })
            },
            changeStatus(){
                if(this.statusOption == 'cheque')
                    this.status = false;
                else{
                    this.status = true;
                    this.bank_name = null;this.branch = null;this.cheque_no=null;this.cheque_amount=null;
                    this.cheque_date=null;
                }
            },
            danger(){
                this.alert_danger = false;
            },
            success(){
                this.alert_success = false;
            },

        },
        computed:{
            getPartStud(){
                this.student = null
                axios.get('/date/students/all/'+this.classnames).then(resp=>{
                    this.getStudents = resp.data.data.original.data;
                    this.amount_payable = resp.data.amount;
                    this.allPayables = [];
                    this.allPayables.push(resp.data.amount);
                    this.term = resp.data.term;
                    this.academic = resp.data.academic;
                })
            },
            validate(){
                if(this.statusOption == 'cash')
                    return this.amount;
                else{
                    return this.bank_name && this.branch && this.cheque_no && this.cheque_date && this.amount;
                }
            }

        },
        watch:{
            student:function (value) {
                this.allPayables.push(this.amount_payable)
                axios.get('/date/students/all/previous/'+value.id)
                    .then(resp=>{
                        console.log(resp.data)
                        if(resp.data.status == 'some'){
                            this.amount_payable = resp.data.data;
                            this.previous = 0;
                        }else if(resp.data.status == 'pre'){
                            this.amount_payable =  parseInt(this.allPayables[0]) + parseInt(resp.data.data);
                            this.previous = 0;
                        }else{
                            this.amount_payable =  this.allPayables[0];
                            this.previous = 0;
                        }


                    })
            },
            amount:function (value) {
                this.balance = parseInt(this.amount_payable) - parseInt(value);
            },

        },
        mounted(){
            axios.get('/date/classes/show-all').then(resp=>{
                this.getClasses = resp.data;
            })
        }
    }
</script>

<style scoped>
    a.disabled {
        pointer-events: none;
    }
</style>