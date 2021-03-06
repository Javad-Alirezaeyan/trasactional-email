
<h2>Transactional Email Microservice</h2>

A complete project to send  emails with Restful API

<h3>Introduction</h3>
This service makes a confident service to transmit bulk emails. It uses multi online transactional email service 
(such as Sendergrid, Mailjet, Mailgunn, Mailtrap, ... ) to deliver emails.

The service is available on both 
<a target="_blank" href="https://documenter.getpostman.com/view/1601502/SVYxnFT2?version=latest#3d9433d4-387e-4508-a6f9-69067f521bd0" > API </a>
 and UI. To see API document 
 <a target="_blank" href="https://documenter.getpostman.com/view/1601502/SVYxnFT2?version=latest#3d9433d4-387e-4508-a6f9-69067f521bd0" > click here</a> 

 This service has configured with Docker, so you can use it in your convenient platform. 


<h3>My problem with some external services</h3>

There are some problems  working  with external services, In the following you can see some of them:
<ul>
<li>This services has bounded the number of emails that you can send in each month, for example, Sendgrid service just allows you send 100 emails in each month freely </li>
<li>None of the services  allow  you that get information about the state of each sent emails, I mean there is no way knowing if a special email is delivered, not-delivered or bounced. If you have promoted an account, 
 the Sendgrid service only let you fetch information about your activity <a target="_blank" href="https://sendgrid.com/docs/for-developers/sending-email/getting-started-email-activity-api">[See this link]</a>.
  So, in the web application, we can just see an email if queued in the database or sent to external service because of the mentioned reasons.
  </li>
<li>It seems,  accessing to Mailjet is access denied in my country because of some political reasons </li>
</ul>

<b>Although connecting to the mentioned external services has been implemented, this service can only send the emails by
 Sendgrid API maximum of 100 emails each month. If you have any account on Sndergrid, you can change the authorization 
  key in path /app/classes/Sendergrid.php</b>

<hr />
<h4> Technical</h4>  
Used techniques are presented in the following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel version 5.8</li>
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

<hr />

<h3>description</h3>

As mentioned above, the service uses verity of programming languages, frameworks, and tools, so it is 
explained why they have been chosen in the following:

<h4>Laravel and Vuejs</h4>

 Laravel is one of the popular frameworks among PHP developers because it provides tones of services and facilities 
 to make reliable projects. As well Vue.js is an open-source JavaScript framework for building user interfaces that helps you to create a strong application in front-end. These two frameworks are matching each other well.
 
<h4>SOLID</h4>

The service uses a few different external services to send emails, so there has implemented a structure based on object-oriented 
and SOLID. These files are available in the path: /app/classes. First, it has created an interface that all services have to include the functions of the interface. Also, there the main class (/app/classes/EmailService.php)that determines which service must be selected as the email sender. In fact, this class gets an email from dispatcher and sends it calls the selected class for sending the email.

<h4>PHPUnit</h4>

To test API in the back-end, the service uses PHPUnit. The related files are available in the path /test. The test includes checking all method in the API such as POST, GET, Delete, ...
 Faker library is used to make fake data to test API. These files are available in path /database/factories
 
 <hr/>
 
<h3>install</h3> 
 
 1. Clone the source code from github repository. To do that open terminal and type the following command:
  
  <code>
    git clone https://github.com/javad86/trasactional-email.git
    </code>
          
 2. Then, open the trasactional-email directory with command: 
 
 <code>cd trasactional-email </code>
  
  and run the following commands  to build nginx, mysql and laravel project to the containers of docker
    
  <code>
        docker-compose build
  </code>
      
  <code>
    docker-compose up -d
  </code>
  
    
    you should see printed comments in the following:
       <code>
       Creating app       ... done
       
       Creating webserver ... done
       
       Creating db        ... done
       </code> 
    
 3. Now, the necessary files and software has been installed on your computer. Type the following code to see container on docker service:
 
 <code>
    docker-compose ps
    </code>
you should see something like the following  text after running the above command:


 
    CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                                      NAMES
    
    9ae2ab01f3ab        nginx:alpine           "nginx -g 'daemon of…"   14 hours ago        Up 9 minutes        0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp   webserver
    
    c583fd40ab38        digitalocean.com/php   "docker-php-entrypoi…"   14 hours ago        Up 9 minutes        9000/tcp                                   app
    
    ea6aab48faf9        mysql:5.7.22           "docker-entrypoint.s…"   14 hours ago        Up 9 minutes        0.0.0.0:3306->3306/tcp                     db




 4. You can now modify the .env file on the app container to include specific details about your setup.
    
  Open the file using 
  
  <code>docker-compose exec</code>, 
  
 which allows you to run specific commands in containers.
   In this case, you are opening the file for editing:
  
  <ul>
  <li><code>DB_HOST</code> will be your <code>db</code> database container. </li>
  <li><code>DB_DATABASE</code> will be the <code><span class="highlight">email</span></code> database. </li>
  <li><code>DB_USERNAME</code> will be the username you will use for your database. In this case, we will use <code><span class="highlight">root</span></code>. </li>
  <li><code>DB_PASSWORD</code> will be the secure password you would like to use for this user account. the default password is <code>qaz</code> </li>
  </ul>
  
  <pre class="code-pre "><code langs="">
  DB_CONNECTION=mysql
  DB_HOST=<span class="highlight">db</span>
  DB_PORT=3306
  DB_DATABASE=<span class="highlight">email</span>
  DB_USERNAME=<span class="highlight">root</span>
  DB_PASSWORD=<span class="highlight">qaz</span>
  </code></pre>
  
  Save your changes and exit your editor. 
  
  
 the two commands needed would look like:
 
  <code>
  docker-compose exec app php artisan key:generate
  
  docker-compose exec app php artisan optimize
  </code>
  
  5. You now run migrate command to create tables: 
  
  <code>
  docker-compose exec app php artisan migrate
  </code>
 
 then, you must see:
     
     Migrating: 2019_08_12_175201_create_emails_table
     Migrated:  2019_08_12_175201_create_emails_table (0.08 seconds)
     Migrating: 2019_08_12_175201_create_failed_jobs_table
     Migrated:  2019_08_12_175201_create_failed_jobs_table (0.07 seconds)
     Migrating: 2019_08_12_175201_create_jobs_table
     Migrated:  2019_08_12_175201_create_jobs_table (0.13 seconds)
     Migrating: 2019_08_12_175201_create_password_resets_table
     Migrated:  2019_08_12_175201_create_password_resets_table (0.08 seconds)
     Migrating: 2019_08_12_175201_create_users_table
     Migrated:  2019_08_12_175201_create_users_table (0.1 seconds)
 
 
 6. To run queued work  this command must be run: 
  <code>
   docker-compose exec app php artisan queue:listen
  </code>
  It is better we define a cron job for this command when we export the  project
  
 Note: If you would like to have some dat in database, you can run the following command. 
 
 <code>
 docker exec app php artisan db:seed
 </code>
 
<u>This command generates  the correct format of dummy data for us</u>
 
 As a final step,  visit http://your_server_ip:8080 in the browser. 
 API is available  in  http://your_server_ip:8080/api/<request>, 
 for more detail about API <a target="_blank" href="https://documenter.getpostman.com/view/1601502/SVYxnFT2?version=latest#3d9433d4-387e-4508-a6f9-69067f521bd0" > click here</a> 