<template>
    <div>
        <div class="modal-dialog modal-xl mt-5">    
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="text-secondary"> {{ receiver.name }} </h3>
                    <button type="button" data-dismiss="modal" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    
                    <div v-for="message in chat">
                        <div :class="MessageClass(message)" >
                            <slot>{{message.body}}</slot>
                        </div>
                            
                    </div>
                   
                </div>
                <div class="modal-body">
                    <input type="text" v-model="message" @keyup.enter="send" class="form-control" placeholder="type your message here...">
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                message: '',
                userMessages: [],
                chat: [],
            };
        },
        props: [
            'receiver', 'sender'
        ],

        computed: {
            
            
        },
         methods: {
             MessageClass(message) {
                if(message.sender_id === this.sender.id){
                    return 'list-group-item list-group-item-warning my-2';
                } else {
                    return 'list-group-item list-group-item-success my-2';
                }
                
            },
            badgeClass(message) {
                if(message.sender === this.currentuser.id){
                    return 'badge-warning';
                }  else {
                    return 'badge-dark';
                }
            },
            getMessages () {
                
                axios.get('/getMessages/')
                .then((response) => {
                    this.userMessages = response.data;
                });
            },
            send(){
                if(this.message.length != 0) {
                    axios.post(`api/send`, {
                        api_token: this.sender.api_token,
                        body: this.message,
                        sender_id: this.sender.id,
                        receiver_id: this.receiver.id
                    })
                    .then(response => {
                        this.chat.push(response.data);
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
                    
                }
                
            },
            listen() {
                console.log(this.sender.id);
                Echo.channel('chat.'+this.sender.id)
                    .listen('NewMessage', (new_message) => {
                    this.chat.push(new_message.message);
                    // this.userMessages.push(new_message);
                    // console.log(new_message);
                    });
            }
        },
        mounted(){
            this.getMessages();
            this.listen();

            
           
            

        },
        watch: {
      	receiver: function(newVal, oldVal) { // watch it
            this.chat = [];
            this.getMessages();
            this.userMessages.forEach((message) => {
                if(message.sender_id === this.receiver.id || message.receiver_id === this.receiver.id ) {
                    this.chat.push(message);
                }
            });
        }
      }
    }
</script>