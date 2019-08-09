<template>
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
        <tr v-bind:key="email.email_id" v-for="email in emails">
            <td style="width:40px">
                <div class="checkbox">
                    <input id="checkbox0" type="checkbox" value="check">
                    <label for="checkbox0"></label>
                </div>
            </td>
            <td class="hidden-xs-down" style="width:40px"><i class="fa fa-star-o"></i></td>
            <td class="hidden-xs-down">{{ email.email_to }}</td>
            <td class="hidden-xs-down">{{ email.email_subject }}</td>
            <td class="hidden-xs-down">{{ email.email_contentValue }}</td>
            <td class="text-right"> {{ email.createdat}}</td>
            <td class="hidden-xs-down">{{ email.email_state }}</td>

        </tr>
        </tbody>


    </table>

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
                    'content': ''
                },
                'email_id': '',
                'pagination': [],
                'edit': false,
            }
        },
        created() {
            this.fetchEmails();
        }
        ,
        methods: {
            fetchEmails() {
                fetch("api/all")
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.emails = res;
                    })
            }
        }
    }

</script>

