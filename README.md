## video sharing website
A YouTube-like website with strong administration capabilities for sharing videos, creating channels, etc..., uses Amazon S3 as storage.

you can find an installation guide bellow.

## screenshots

show the most viewed videos on the home page :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/09dd5383-42a5-48f5-902e-59712c6f1932)

the user can change the quality of a video, interact (like/dislike), comment, delete, or edit his comment :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/0e4e3631-6694-4911-8e8a-36188dea55cf)
![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/915aa07d-cfc1-422f-9015-e1880eb2eef7)

the user can view the watch history, remove a video from the history, or empty it :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/26e5776a-b191-43d7-bfc4-7e7334b3ca44)

the user can upload a video to his channel and use the website while the video is processed and uploaded in the background :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/d88d51d5-0b6c-4438-9093-fa4c62e3bac0)
![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/c2b7a65a-ed41-4c22-8c2d-9ff26974df19)

the user can view the video on his channel and get a notification that the video is uploaded :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/f744f69a-6b37-4dd1-8359-368aba68b222)

the user can view recent channels :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/28548300-2de6-461f-b931-d81f8f2f8185)

the user can search for channels or videos :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/38a57339-6f71-40e4-994b-5c9ea9afde52)

the user can update his information, change password, activate two-factor authentication ,manage sessions on other browsers, delete the account from the edit account page :

![image](https://github.com/AHMED-GAMAL-AG/instagram_demo/assets/76778937/3bbaaa81-e376-419b-ac48-c30c83c27e87)
![image](https://github.com/AHMED-GAMAL-AG/instagram_demo/assets/76778937/bebbbd92-4deb-47b7-ad1f-f7d1cfe41792)
![image](https://github.com/AHMED-GAMAL-AG/instagram_demo/assets/76778937/0a1efacf-50a4-4c82-98d8-e436af08c4e4)

the admin can access the dashboard and view the analytics of the website (videos/channels count) and a Graph with the most viewed videos on the website :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/bb5ae55d-4def-4189-8280-0dc42047445e)
![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/70e8e84d-98f8-4186-ac60-f06a544474a9)

the admin can make any user administrator or normal user, delete, or block a user :
![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/cd321c55-0204-4e93-91dd-aa927a12503b)

the admin can view the statistics of the channels :

![image](https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform/assets/76778937/13cfeb5a-5e41-4ccc-95e0-35cfb1377e6b)

## installation

<ul>
<li><code>git clone https://github.com/AHMED-GAMAL-AG/Video_Sharing_Platform.git</code></li>
<li><code>Create a .env file and configure the database.</code></li>
<li><code>composer install</code></li>
<li><code>npm install</code></li>
<li><code>php artisan key:generate</code></li>
<li><code>php artisan migrate --seed</code></li>
<li><code>php artisan storage:link</code></li>
</ul>

