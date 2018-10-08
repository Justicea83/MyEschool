<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                <div class="col-lg-12 clear-padding-xs" v-show="alert_danger">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" @click="danger"  class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> Could't send message
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 clear-padding-xs" v-show="alert_success">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">
                            <button type="button" @click="success" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Success!</strong> Message Sent Successfully
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" v-if="loading">
                <div class="loader"></div>
            </div>
            <div v-if="!all">
                <div class="form-group">
                    <label for="" class="control-label">Parents</label>
                    <v-select multiple v-model="parents" label="fname"  :options="allParents">
                    </v-select>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Telephone</label>
                    <input type="tel" v-on:keyup="visibleInput" class="form-control" placeholder="0244444440" v-model="tel">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="">Message</label>
                <textarea name="" v-model="message" class="form-control"></textarea>
            </div>
            <div>
                <div class="checkbox">
                    <label><input type="checkbox" v-model="all">To All Parents</label>
                </div>
                <a href="#" @click.prevent="send" :class="{'disabled':!validate}" class="btn btn-success pull-right" >
                    <i class="fa fa-paper-plane"></i>
                    Send
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import VSelect from 'vue-select';
    export default {
        name: "sms_parent",
        components:{
            VSelect
        },
        data(){
            return {
                allParents:null,
                parents:null,
                message:'',
                all:false,
                tel:null,
                loading:false,
                alert_danger:false,
                alert_success:false,
            }
        },
        computed:{
          validate(){
              if(this.all)
                  return this.message;
              else
                  return (this.parents || this.tel) && this.message;
          }
        },
        methods:{
          send(e){
              this.loading = true;
              e.target.classList.add('disabled');
              if(this.all){
                  $.each(this.allParents,(key,value)=>{
                        let contact = value.contact;
                        if(contact[0] != '+')
                            contact = contact.replace(contact[0],'+233');
                      this.sendSMS(value.name,contact,e);
                  })
              }else if(this.tel != null){
                  let contact =  this.tel;
                  if(contact[0] != '+')
                      contact = contact.replace(contact[0],'+233');
                  this.sendSMS("Unique",contact,e);
              }else if(this.parents != null){
                    $.each(this.parents,(key,value)=>{
                        let contact = value.contact;
                        if(contact[0] != '+')
                            contact = contact.replace(contact[0],'+233');
                        this.sendSMS(value.name,contact,e);
                    })
              }
              this.loading = false;
              e.target.classList.remove('disabled');
              this.tel = null;
              this.message = null;
              this.parent = null;
              this.parents = null;

          },
            sendSMS(from,to,e){
                let instance = axios.create();
                delete instance.defaults.headers.common['X-CSRF-TOKEN'];
                delete instance.defaults.headers.common['X-Requested-With'];
                instance({
                    method:'POST',
                    url:'http://api.infobip.com/sms/2/text/single',
                    data:{
                        "to":to,
                        "from":from,
                        'text':this.message
                    },
                    auth: {
                        username: 'demo@09',
                        password: 'Demo@10'
                    },
                    headers:{
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    }
                })
                    .then(resp=>{
                        if(resp.status == 200)
                            this.alert_success = true;
                    })
                    .catch(error=>{
                        this.alert_danger = true;
                    })
                    .finally(()=>{

                    });
            },
            danger(){
              this.alert_danger = false;
            },
            success(){
              this.alert_success = false;
            },
            visibleInput(){
              //this.parents = null;
            }
        },
        mounted(){
            axios.get('/date/parents/all')
                .then(data=>{
                    this.allParents = data.data;
                })
        }
    }

</script>

<style scoped>
    .disabled {
        pointer-events: none;
    }
    .cColor{
        color: #2ab27b;
    }
    .loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #5e8e05; /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>