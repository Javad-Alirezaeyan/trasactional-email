<template>
    <div >
        <div v-if="showList == true">
            <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                <button type="button" title="" class="btn btn-secondary font-18 text-dark" ><i class="mdi mdi-inbox-arrow-down"></i></button>
                <button type="button" title="delete selected Items" class="btn btn-secondary font-18 text-dark" v-on:click="deleteItems()"><i class="mdi mdi-delete" ></i></button>
            </div>
            <button type="button " title="refresh list" class="btn btn-secondary m-r-10 m-b-10 text-dark" v-on:click="refreshItems()"><i class="mdi mdi-reload font-18"></i></button>

            <div class="btn-group m-b-10 m-r-10 " role="group" aria-label="Button group with nested dropdown">
                <span style=" margin-right: 5px">{{fromNumber}}-{{ toNumber}} of {{ allCount }}</span>
                <button :aria-disabled="checkPrevDisable" type="button" title="" class="btn btn-secondary font-18 text-dark" v-on:click="prevpage()" ><i class="mdi mdi-arrow-left"></i></button>
                <button :aria-disabled="checkNextDisable" type="button" title="delete selected Items" class="btn btn-secondary font-18 text-dark" v-on:click="nextpage()"  ><i class="mdi mdi-arrow-right" ></i></button>
            </div>
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
                                <td class="hidden-xs-down">  <a v-on:click="showdetail(email.id)" href="#">{{ email.to.substr(0, 20) }}</a></td>
                                <td class="hidden-xs-down">   <a v-on:click="showdetail(email.id)" href="#">{{ email.subject.substr(0, 20) }}</a></td>
                                <td class="hidden-xs-down">   <a v-on:click="showdetail(email.id)" href="#">{{ email.content.substr(0, 20) }}</a></td>
                                <td class="text-right">   <a v-on:click="showdetail(email.id)" href="#"> {{ email.date}}</a></td>
                                <td class="hidden-xs-down">
                                    <a v-on:click="showdetail(email.id)" href="#">
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
       <div v-if="showList == false">
           <detail-email v-bind:params="{selectedId }" ></detail-email>
       </div>
    </div>

</template>

<script>
    export default {

        data() {
            return {
                'emails': [],
                state : -1,
                deleted : 0,
                page : 1,
                count : 10,
                allCount : 0,
                fromNumber : 0,
                toNumber : 0,
                nextBtnDisable : false,
                prevBtnDisable : false,
                showList : true,
                selectedId : -1,
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
                fetch("api/email"+"?state="+this.state+"&deleted="+this.deleted+"&count="+this.count+"&page="+this.page)
                    .then(res => res.json())
                    .then(res => {
                       // console.log(res.result);
                        this.nextBtnDisable = false;
                        this.prevBtnDisable = false;

                        this.emails = res.result.emails;
                        this.page = parseInt(res.result.page);
                        this.count = parseInt(res.result.count);
                        this.allCount = parseInt(res.result.all);
                        if (this.allCount > 0){
                            this.fromNumber = (this.page -1) * this.count + 1;
                        }
                        else{
                            this.fromNumber = 0;
                        }
                        if (this.allCount >= 10){
                            this.toNumber =  parseInt(this.fromNumber + this.count -1);
                        }
                        else{
                            this.toNumber =  this.allCount
                        }

                        if ( this.toNumber > this.allCount) {
                            this.toNumber = this.allCount;
                            this.nextBtnDisable = true;
                        }
                        if (this.page == 1){
                            this.prevBtnDisable = true;
                        }

                    })
            },
            refreshItems(){
                this.fetchEmails();
            },
            deleteItems(){

                let bodyJson =  JSON.stringify({'idList' : this.selectedList});
                fetch("api/email", {
                    method: 'Delete',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: bodyJson,
                }).then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.selectedList = [];
                        this.fetchEmails();
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

            },
            changeState(state){
                this.state = state;
                this.deleted = 0;
                this.fetchEmails();

            },
            getDeletedEmail(){
                this.deleted = 1;
                this.state = -1;
                this.fetchEmails();
            },
            allEmail(){
                this.state = -1;
                this.deleted = 0;
                this.fetchEmails();
            },
            showdetail(id){
                this.selectedId = id;
                this.showList = false;
            },
            prevpage(){
                if (this.page == 1) {
                    return;
                }
                this.page -= 1;
                this.fetchEmails();
            },
            nextpage(){
                if (this.toNumber >= this.allCount) {
                    return;
                }
                this.page += 1;
                this.fetchEmails();
            },
            checkPrevDisable(){
                return this.prevBtnDisable;
            },
            checkNextDisable(){
                return this.nextBtnDisable;
            }
        }
    }

</script>

