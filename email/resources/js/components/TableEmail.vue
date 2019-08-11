<template>
    <table class="table table-hover no-wrap">
        <thead>
        <tr>
            <td>Select</td>
            <td>Star</td>
            <td>To</td>
            <td>From</td>
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
                    <input id="checkbox0" type="checkbox" value="check">
                    <label for="checkbox0"></label>
                </div>
            </td>
            <td class="hidden-xs-down" style="width:40px"><i class="fa fa-star-o"></i></td>
            <td class="hidden-xs-down">{{ email.to }}</td>
            <td class="hidden-xs-down">{{ email.from }}</td>
            <td class="hidden-xs-down">{{ email.subject }}</td>
            <td class="hidden-xs-down">{{ email.content }}</td>
            <td class="text-right"> {{ email.date}}</td>
            <td class="hidden-xs-down">{{ email.state }}</td>

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
                    'content': '',
                    'state' : ''
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
                       // console.log(res);
                        this.emails = res;
                    })
            }
        }
    }

</script>

