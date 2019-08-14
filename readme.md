##Transactional Email Microservice
A complete project to send  emails with Restful API
### Introduction
This service makes a confident service to transmit bulk email. This service uses multi online transactional email service 
(such as Sendergrid, Mailjet, Mailgunn, Mailtrap, ... ) to deliver emails.

The service is available on both API and UI.

 This service has configured with Docker, so you can use it in your convenient platform. 


###My problem with some external services
There are some problems  working  with external services, In the following you can see some of them:
<ul>
<li>This services has bounded the number of emails that you can send in each month, for example, Sendgrid service just allows you send 100 emails in each month freely </li>
<li>None of the services  allow  you that get information about the state of each sent emails, I mean there is no way knowing if a special email is delivered, not-delivered or bounced. If you have promoted an account, 
 the Sendgrid service only let you fetch information about your activity <a href="https://sendgrid.com/docs/for-developers/sending-email/getting-started-email-activity-api">[See this link]</a>.
  So, in the web application, we can just see an email if queued in the database or sent to external service because of the mentioned reasons.
  </li>
<li>It seems,  accessing to Mailjet is access denied in my country because of some political reasons </li>
</ul>

<b>Although connecting to the mentioned external services has been implemented, this service can only send an email by
 Sendgrid API maximum of 100 emails each month. If you have any account on Sndergrid, you can change the authorization 
  key in path /app/classes/Sendergrid.php</b>

### Technical  
Used techniques are presented in following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel versin 5.8</li>
<li>Vuejs</li>
<li>Jquery</li>
</ul>

tools:
<ul>
<li>Docker</li>
<li>Compose</li>
<li>Git</li>
</ul>

Other:
<ul>
<li>PHPUnit</li>
<li>Object orinted</li>
<li>SOLID</li>
<li>Cache</li>
<li>Queue Laravel</li>
<li>psr-2</li>
<li>facade in Laravel</>
</ul>



##description
As mentioned above, the service uses verity of programming languages, frameworks, and tools, so it is 
explained why they have been chosen in the following:
#####Laravel and Vuejs
 Laravel is one of the popular frameworks among PHP developers because it provides tones of services and facilities 
 to make reliable projects. As well Vue.js is an open-source JavaScript framework for building user interfaces that helps you to create a strong application in front-end. These two frameworks are matching each other well.
 
#####SOLID
The service uses a few different external services to send emails, so there has implemented a structure based on object-oriented 
and SOLID. These files are available in the path: /app/classes. First, it has created an interface that all services have to include the functions of the interface. Also, there the main class (/app/classes/EmailService.php)that determines which service must be selected as the email sender. In fact, this class gets an email from dispatcher and sends it calls the selected class for sending the email.

####PHPunit
To test API in the back-end, the service uses PHPUnit. The related files are available in the path /test. The test includes checking all method in the API such as POST, GET, Delete, ...
 Faker library is used to make fake data to test API. These files are available in path /database/factories
 
 
 ####install 
 