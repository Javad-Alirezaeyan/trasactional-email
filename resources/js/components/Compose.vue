<template>

    <div class="card-block">
        <h3 class="card-title">Compose New Message</h3>
        <div v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
                <li class="text-danger" v-for="error in errors">{{ error }}</li>
            </ul>
        </div>


        <div class="form-group">
            <p>please distract emails with coma (,) if you want to insert more than one email</p>
            <input class="form-control" id="to" data-role="tagsinput"  v-model="to"  placeholder="To:">
        </div>
        <div class="form-group">
            <input class="form-control" v-model="subject" placeholder="Subject:"  value="Hello">
        </div>
        <div class="form-group">
            <input class="form-control" v-model="from" placeholder="from:"  value="a@gmail.com">
        </div>
        <div class="form-group">
            <textarea class="textarea_editor form-control" v-model="content"  value="Test" rows="15" placeholder="Enter text ..."></textarea>
        </div>
        <h4><i class="ti-link"></i> Attachment</h4>
        <!--<form action="#" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>-->
        <button type="submit" v-on:click="validation"  class="btn btn-success m-t-20"><i class="fa fa-envelope-o"></i> Send</button>
        <button class="btn btn-inverse m-t-20"><i class="fa fa-times"></i> Discard</button>
    </div>


</template>

<script>

    export default {

        mounted() {

            // /console.log('Component mounted.')
        },

        data() {

            return {
                subject: '',
                content: '',
                from : '',
                to: '',
                errors: []
            };

        },

        methods: {

            validation(){
                //validate form
                let to = ($("#to").val().replace(/ /g,'')).split(',');
                console.log(to);
                let valid =  true;
                this.errors = [];
                for (let i= 0; i < to.length; i++){
                    if ( !validateEmail(to[i]) ){
                        this.errors.push(to[i] +" isn't a valid email");
                        valid = false;
                    }
                }

                if ( !validateEmail(this.from) ){
                    this.errors.push("Email(from) is invalid");
                    valid = false;
                }

                if ( this.subject ==  "" ){
                    this.errors.push("subject can't be empty");
                    valid = false;
                }
                if ( this.content.length  == "" ){
                    this.errors.push("context can't be empty");
                    valid = false;
                }
                if (valid){
                    this.submit();
                }
            },
            submit() {
                //send data to api
                let currentObj = this;
                let senddata = {
                    subject: this.subject,
                    from: this.from,
                    to : $("#to").val() ,
                    contentValue : this.content,
                    contentType :  "text/plain"
                };
              // /  console.log(senddata);
                $.ajax({
                    url: "api/email",
                    type: 'post',
                    data: senddata,
                    dataType: 'json',
                })
                    .done(function (res, textStatus, xhr) {
                        if (xhr.status == 200){
                            //show confirmation
                            alert("Your email was queued, It will send in one minute");
                            var baseUrl = window.Laravel.baseUrl;
                            window.location.href  = baseUrl;
                        }
                        else{
                            this.errors = res.errors;
                        }
                    })
                    .fail(function (jqXHR, textStatus) {
                        console.log(jqXHR.responseText);
                    });
            }

        }

    }

</script>

