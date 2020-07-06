<template>
    <div>
        <div class="container py-3" v-for="user in users">
            <a class="btn btn-info btn-block" data-toggle="modal" data-target="#myModal" @click="updateReceiver(user)">{{user.name}}</a>

            <div class="modal fade " id="myModal" role="dialog" v-if="load_message">
                <chat-component
                    :receiver= "sendTo"
                    :sender= "current_user"
                ></chat-component>
            </div>
        </div>
    </div>
</template>

<script>
     export default {
         data() {
            return {
                current_user: {},
                users: [],
                sendTo: {},
                load_message: false,            
            }
        },
       async mounted() {
           await axios.get('/getUsers')
                .then((response) => {
                    this.users = response.data; 
                });

           await axios.get('/getCurrentUser/')
                .then( response => {
                    this.current_user = response.data;
                });
            this.load_message = true;
        },

        methods: {
            updateReceiver(user) {
                this.sendTo = user;
                
            }
        }

    }
</script>
