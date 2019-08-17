<template>
    <div class="card-block " >
        <div class="card b-all shadow-none">
            <div class="card-block">
                <h3 class="card-title m-b-0">{{ email.subject }}</h3>
            </div>
            <div>
                <hr class="m-t-0">
            </div>
            <div class="card-block">
                <div class="d-flex m-b-40">
                    <div>
                        <a href="javascript:void(0)"><img src= "/theme/assets/images/users/1.jpg" alt="user" width="40" class="img-circle" /></a>
                    </div>
                    <div class="p-l-10">
                        <h4 class="m-b-0"></h4>
                        <span>from:</span>
                        <small class="text-muted">{{ email.from }}</small>
                        <hr/>
                        <span>to:</span>
                        <small class="text-muted">{{ email.to }}</small>
                        <hr />
                        <span>date:</span>
                        <small class="text-muted">{{ email.date }}</small>
                    </div>
                </div>

                <div>
                    {{ email.content }}
                </div>
            </div>
            <div>
                <hr class="m-t-0">
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "EmailDetail",
        props:['params'],

        data() {
            return {
                'email': [],
                'to': '',
                'from': '',
                'subject': '',
                'content': '',
                'state' : ''
            }
        },
        created() {
            this.fetchEmail();
        }
        ,
        methods: {
            fetchEmail() {
               let id = this.params.selectedId;
                let baseUrl = window.Laravel.baseUrl;
                fetch(baseUrl+"/api/email/"+ id )
                    .then(res=> res.json())
                    .then(res => {
                        this.email = res.result;
                        console.log(this.email );
                    })
            },
            setId(){
                this.id = id;
                this.fetchEmail();
            }

        }
    }

</script>