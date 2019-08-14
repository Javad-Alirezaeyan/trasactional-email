<template>
    <div class="col-xlg-10 col-lg-8 col-md-8">
        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
            <button type="button" title="" class="btn btn-secondary font-18 text-dark" ><i class="mdi mdi-inbox-arrow-down"></i></button>
            <button type="button" title="delete selected Items" class="btn btn-secondary font-18 text-dark" v-on:click="deleteItems()"><i class="mdi mdi-delete" ></i></button>
        </div>
        <button type="button " title="refresh list" class="btn btn-secondary m-r-10 m-b-10 text-dark" v-on:click="refreshItems()"><i class="mdi mdi-reload font-18"></i></button>

        <div class="card-block p-t-0">
            <div class="card b-all shadow-none">
                <div class="inbox-center table-responsive">
                    <table class="table table-hover no-wrap">
                        <thead>
                        <tr>
                            <td>Select</td>
                            <td>Star</td>
                            <td>To</td>
                            <td>Subject</td>
                            <td>Content</td>
                            <td>Date</td>
                            <td>State</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-bind:key="email.id" v-for="email in emails">
                            <td style="width:40px">
                                <div class="checkbox">
                                    <input :id="'a'+email.id" type="checkbox" v-on:click="selectEmail(email.id, $event)" value="check">
                                    <label :for="'a'+email.id" ></label>
                                </div>
                            </td>
                            <td class="hidden-xs-down" style="width:40px"><i class="fa fa-star-o"></i></td>
                            <td class="hidden-xs-down">  <a v-bind:href="'detail/'+email.id">{{ email.to.substr(0, 20) }}</a></td>
                            <td class="hidden-xs-down">   <a v-bind:href="'detail/'+email.id">{{ email.subject.substr(0, 20) }}</a></td>
                            <td class="hidden-xs-down">   <a v-bind:href="'detail/'+email.id">{{ email.content.substr(0, 20) }}</a></td>
                            <td class="text-right">   <a v-bind:href="'detail/'+email.id"> {{ email.date}}</a></td>
                            <td class="hidden-xs-down">
                                <a v-bind:href="'detail/'+email.id">
                                    <span v-bind:class="'label '+email.stateInfo.ColorClass">{{ email.stateInfo.Title }}</span>
                                </a>
                            </td>



                        </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>



</template>

<script>
    export default {
        data() {
            return {
                'emails': [],
                'email': {
                    'to': '',
                    'from': '',
                    'subject': '',
                    'content': '',
                    'state' : ''
                },
                'id': '',
                'pagination': [],
                'edit': false,
                'selectedList':[]
            }
        },
        created() {
            this.fetchEmails();
        }
        ,
        methods: {

            fetchEmails() {
                fetch("api/email")
                    .then(res => res.json())
                    .then(res => {
                       // console.log(res.result);
                        this.emails = res.result;
                    })
            },
            refreshItems(){
                this.fetchEmails();
            },
            deleteItems(){
                $.ajax({
                    url: "api/email",
                    type: 'PUT',
                    data: this.selectedList,
                    dataType: 'json',
                })
                    .done(function (res, textStatus, xhr) {
                        if (xhr.status == 204){
                            //show confirmation
                            this.emails = [];
                        }
                        else{
                            this.errors = res.errors;
                        }
                    })
                    .fail(function (jqXHR, textStatus) {
                        console.log(jqXHR.responseText);
                    });
            },

            selectEmail(id, event){
               if (event.target.checked){
                   this.selectedList.push(id);
               }
               else{
                   for( var i = 0; i < this.selectedList.length; i++){
                       if ( this.selectedList[i] === id) {
                           this.selectedList.splice(i, 1);
                       }
                   }
               }

            }
        }
    }

</script>

